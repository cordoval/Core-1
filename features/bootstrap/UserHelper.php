<?php

use OpenTribes\Core\Player;
use OpenTribes\Core\Player\Roles as PlayerRoles;
use OpenTribes\Core\Role\Mock\Repository as RoleRepository;
use OpenTribes\Core\Player\Roles\Mock\Repository as PlayerRolesRepository;
use OpenTribes\Core\Player\Mock\Repository as PlayerRepository;
use OpenTribes\Core\Util\Mock\Hasher as MockHasher;
use OpenTribes\Core\Util\Mock\QwertyGenerator as MockCodeGenerator;
use OpenTribes\Core\Util\Mock\Filemailer as MockMailer;
use OpenTribes\Core\Role;
use OpenTribes\Core\Player\Create\Request as PlayerCreateRequest;
use OpenTribes\Core\Player\Create\Interactor as PlayerCreateInteractor;
use OpenTribes\Core\Player\Login\Request as PlayerLoginRequest;
use OpenTribes\Core\Player\Login\Interactor as PlayerLoginInteractor;
use OpenTribes\Core\Player\ActivationMail\Create\Request as CreateActivationMailRequest;
use OpenTribes\Core\Player\ActivationMail\Create\Interactor as CreateActivationMailInteractor;
use OpenTribes\Core\Player\ActivationMail\Send\Request as SendActivationMailRequest;
use OpenTribes\Core\Player\ActivationMail\Send\Interactor as SendActivationMailInteractor;
use OpenTribes\Core\Player\Activate\Request as PlayerActivateRequest;
use OpenTribes\Core\Player\Activate\Interactor as PlayerActivateInteractor;
use OpenTribes\Core\Entity\Factory as EntityFactory;
require_once 'vendor/phpunit/phpunit/PHPUnit/Framework/Assert/Functions.php';

class UserHelper {

    protected $user;
    protected $roleRepository;
    protected $playerRepository;
    protected $response;
    protected $codeGenerator;
    protected $exception = null;
    protected $mailer = null;

    public function __construct() {
        $this->roleRepository = new RoleRepository();
        $this->playerRepository = new PlayerRepository(new EntityFactory(new Player()));
        $this->playerRolesRepository = new PlayerRolesRepository();
        
        $this->hasher = new MockHasher();
        $this->codeGenerator = new MockCodeGenerator();
        $this->mailer = new MockMailer();
        $this->initRoles();
     
    }
  
     // Default Methods to initialize Data
  
    /**
     * Method to Init base Roles
     */
    private function initRoles() {
        $roleId = 0;
        $guest = new Role();
        $roleId++;
        $guest->setId($roleId);
        $guest->setName('Guest');

        $player = new Role();
        $roleId++;
        $player->setId($roleId);
        $player->setName('Player');

        $admin = new Role();
        $roleId++;
        $admin->setId($roleId);
        $admin->setName('Admin');

        $this->roleRepository->save($guest);
        $this->roleRepository->save($player);
        $this->roleRepository->save($admin);
    }
    /**
     * Method to create empty user 
     */
    public function newUser() {
        $this->user = new Player();
        $this->user->setRoles(new PlayerRoles());
    }
    /**
     * Methode to add a role to current user
     * @param String $name Rolename
     */
    public function addRole($name) {

        //Load guest role
        $role = $this->roleRepository->findByName($name);
        //Set Roles
        $this->user->getRoles()->addRole($role);
    }
    /**
     * Method to create a DumpUsers, to simulate UserDatabase
     * @param array $data Userdata
     */
    public function createDumpUser(array $data) {

        foreach ($data as $row) {
            $player = new Player();
            $player->setUsername($row['username']);
            $player->setId($row['id']);
            $player->setPassword($this->hasher->hash($row['password']));
            $player->setEmail($row['email']);
            $player->setActivationCode($row['activation_code']);
            $roles = new PlayerRoles();
            $roles->addRole($this->roleRepository->findByName('Player'));
            $player->setRoles($roles);
            $this->playerRepository->save($player);
        }
        
    }
    //Interactor tests
    /**
     * Method to create a use with an interactor
     * @param array $data Userdata
     */
    public function create(array $data) {
        foreach ($data as $row) {
            $request = new PlayerCreateRequest($row['username'], $row['password'], $row['email'], $row['password_confirm'], $row['email_confirm']);
        }

        $interactor = new PlayerCreateInteractor($this->playerRepository, $this->playerRolesRepository, $this->hasher, $this->codeGenerator);
        try {
            $this->response = $interactor($request);
        } catch (\Exception $e) {
            $this->exception = $e;
        }
    }
    /**
     * Method to login as registered User with an interactor
     * @param array $data Userdata
     */
    public function login(array $data) {

        foreach ($data as $row) {
            $request = new PlayerLoginRequest($row['username'], $row['password']);
        }

        $interactor = new PlayerLoginInteractor($this->playerRepository, $this->playerRolesRepository, $this->hasher);

        try {
            $this->response = $interactor($request);
        } catch (\Exception $e) {
            $this->exception = $e;
        }
    }
    /**
     * Method to send an Activation Mail with an interactor
     * it use the response of PlayerCreateInteractor
     */
    public function sendActivationCode() {
        $player = $this->response->getMailView()->getPlayer();

        $request = new SendActivationMailRequest($this->response->getMailView(), $player->getEmail(), $player->getUsername(), 'Activate Account');
        $interactor = new SendActivationMailInteractor($this->mailer);
        $this->response = $interactor($request);
        assertTrue($this->response->getResult());
    }
    /**
     * Method to activate account and set a role for an active use with an interactor
     * @param array $data Userdata
     */
    public function activateAccount(array $data) {
        $role = $this->roleRepository->findByName('Player');
        foreach ($data as $row) {
            $request = new PlayerActivateRequest($row['username'], $row['activation_code'], $role);
        }

        $interactor = new PlayerActivateInteractor($this->playerRepository, $this->playerRolesRepository);
        try {
            $this->response = $interactor($request);
        } catch (\Exception $e) {
            $this->exception = $e;
        }
    }
    //Assertion Methods for testing
    /**
     * Assert Login was successfull
     */
    public function assertIsLoginResponse() {
        assertInstanceOf('\OpenTribes\Core\Player\Login\Response', $this->response);
        assertNotNull($this->response->getPlayer()->getId());
    }
    /**
     * Assert Create Account was successfull
     */
    public function assertIsCreateResponse() {
        assertInstanceOf('\OpenTribes\Core\Player\Create\Response', $this->response);
        assertNotNull($this->playerRepository->findById($this->response->getPlayer()->getId()));
    }
    /**
     * Assert an activation code mail was created with an interactor
     */
    public function assertHasActivationCode() {
        $request = new CreateActivationMailRequest($this->response->getPlayer());
        $interactor = new CreateActivationMailInteractor($this->playerRepository, $this->codeGenerator);
        $this->response = $interactor($request);
        assertInstanceOf('\OpenTribes\Core\Player\ActivationMail\Create\Response', $this->response);
        assertNotNull($this->response->getMailView()->getPlayer()->getActivationCode());
    }
    /**
     * Assert a specific exception
     * @param String $exception Exception name
     */
    public function assertException($exception) {
        assertNotNull($this->exception);
        assertInstanceOf($exception, $this->exception);
    }
    /**
     * Assert account is activated
     */
    public function assertActivated() {
        $player = $this->response->getPlayer();
        assertInstanceOf('\OpenTribes\Core\Player\Activate\Response', $this->response);
        assertEmpty($player->getActivationCode());
    }
    /**
     * Assert account has role
     * @param String $role Role
     */
    public function assertHasRole($role) {
        $player = $this->response->getPlayer();
        assertTrue($player->getRoles()->hasRole($role));
    }

}

?>
