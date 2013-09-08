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

require_once 'vendor/phpunit/phpunit/PHPUnit/Framework/Assert/Functions.php';

class UserHelper {

    protected $user;
    protected $roleRepository;
    protected $playerRepository;
    protected $response;
    protected $codeGenerator;
    protected $exception = null;
    protected $mailer = null;

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

    private function initPlayers() {
        $playerId = 0;
        $player = new Player();
        $playerId++;
        $player->setId($playerId);
        $player->setUsername('BlackScorp');
        $player->setPassword($this->hasher->hash('123456'));
        $player->setEmail('test@test.de');
        $roles = new PlayerRoles();
        $roles->addRole($this->roleRepository->findByName('Player'));
        $player->setRoles($roles);

        $this->playerRepository->save($player);
    }

    public function __construct() {
        $this->roleRepository = new RoleRepository();
        $this->playerRepository = new PlayerRepository();
        $this->playerRolesRepository = new PlayerRolesRepository();
        $this->hasher = new MockHasher();
        $this->codeGenerator = new MockCodeGenerator();
        $this->mailer = new MockMailer();
        $this->initRoles();
    }

    public function newUser() {
        $this->user = new Player();
        $this->user->setRoles(new PlayerRoles());
    }

    public function addRole($name) {

        //Load guest role
        $role = $this->roleRepository->findByName($name);
        //Set Roles
        $this->user->getRoles()->addRole($role);
    }

    public function createDumpUser(array $data) {

        foreach ($data as $row) {
            $player = new Player();
            $player->setUsername($row['username']);
            $player->setId($row['id']);
            $player->setPassword($this->hasher->hash($row['password']));
            $player->setEmail($row['email']);
           
            $player->setActivationCode($row['activation_code']);
            $this->playerRepository->save($player);
        }
    }

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

    public function login(array $data) {
        $this->initPlayers();
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

    public function assertIsLoginResponse() {
        assertInstanceOf('\OpenTribes\Core\Player\Login\Response', $this->response);
        assertNotNull($this->response->getPlayer()->getId());
    }

    public function assertIsCreateResponse() {
        assertInstanceOf('\OpenTribes\Core\Player\Create\Response', $this->response);
        assertNotNull($this->playerRepository->findById($this->response->getPlayer()->getId()));
    }

    public function assertHasActivationCode() {
        $request = new CreateActivationMailRequest($this->response->getPlayer());
        $interactor = new CreateActivationMailInteractor($this->playerRepository, $this->codeGenerator);
        $this->response = $interactor($request);
        assertInstanceOf('\OpenTribes\Core\Player\ActivationMail\Create\Response', $this->response);
        assertNotNull($this->response->getMailView()->getPlayer()->getActivationCode());
    }

    public function assertException($exception) {
        assertNotNull($this->exception);
        assertInstanceOf($exception, $this->exception);
    }

    public function sendActivationCode() {
        $player = $this->response->getMailView()->getPlayer();

        $request = new SendActivationMailRequest($this->response->getMailView(), $player->getEmail(), $player->getUsername(), 'Activate Account');
        $interactor = new SendActivationMailInteractor($this->mailer);
        $this->response = $interactor($request);
        assertTrue($this->response->getResult());
    }

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

    public function assertActivated() {
        $player = $this->response->getPlayer();
        assertInstanceOf('\OpenTribes\Core\Player\Activate\Response', $this->response);
        assertEmpty($player->getActivationCode());
    }

    public function assertHasRole($role) {
        $player = $this->response->getPlayer();
        assertTrue($player->getRoles()->hasRole($role));
    }

}

?>
