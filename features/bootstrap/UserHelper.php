<?php

use OpenTribes\Core\User;
use OpenTribes\Core\User\Roles as UserRoles;
use OpenTribes\Core\Role\Mock\Repository as RoleRepository;
use OpenTribes\Core\User\Roles\Mock\Repository as UserRolesRepository;
use OpenTribes\Core\User\Mock\Repository as UserRepository;
use OpenTribes\Core\Util\Mock\Hasher as MockHasher;
use OpenTribes\Core\Util\Mock\QwertyGenerator as MockCodeGenerator;
use OpenTribes\Core\Util\Mock\Filemailer as MockMailer;
use OpenTribes\Core\Role;
use OpenTribes\Core\User\Create\Request as UserCreateRequest;
use OpenTribes\Core\User\Create\Interactor as UserCreateInteractor;
use OpenTribes\Core\User\Login\Request as UserLoginRequest;
use OpenTribes\Core\User\Login\Interactor as UserLoginInteractor;
use OpenTribes\Core\User\Authenticate\Request as UserAuthenticateRequest;
use OpenTribes\Core\User\Authenticate\Interactor as UserAuthenticateInteractor;
use OpenTribes\Core\User\ActivationMail\Create\Request as CreateActivationMailRequest;
use OpenTribes\Core\User\ActivationMail\Create\Interactor as CreateActivationMailInteractor;
use OpenTribes\Core\User\ActivationMail\Send\Request as SendActivationMailRequest;
use OpenTribes\Core\User\ActivationMail\Send\Interactor as SendActivationMailInteractor;
use OpenTribes\Core\User\Activate\Request as UserActivateRequest;
use OpenTribes\Core\User\Activate\Interactor as UserActivateInteractor;
use OpenTribes\Core\Entity\Factory as EntityFactory;

require_once 'vendor/phpunit/phpunit/PHPUnit/Framework/Assert/Functions.php';

class UserHelper {

    protected $user;
    protected $roleRepository;
    protected $userRepository;
    protected $response;
    protected $codeGenerator;
    protected $exception = null;
    protected $mailer = null;
    protected $userRolesRepository;
 
    public function __construct() {
        $this->roleRepository = new RoleRepository();
        $this->userRepository = new UserRepository();
        $this->userRolesRepository = new UserRolesRepository();

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
        $this->roleRepository->add($guest);
        $user = new Role();
        $roleId++;
        $user->setId($roleId);
        $user->setName('User');
        $this->roleRepository->add($user);
        $admin = new Role();
        $roleId++;
        $admin->setId($roleId);
        $admin->setName('Admin');
        $this->roleRepository->add($admin);
    }

    /**
     * Method to create empty user 
     */
    public function newUser() {
        $this->user = new User();
        $this->user->setRoles(new UserRoles());
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
        $factory = new EntityFactory(new User());
        foreach ($data as $row) {
            $user = $factory->createFromArray($row);
            //hash password
            $user->setPasswordHash($this->hasher->hash($user->getPassword()));
            $roles = new UserRoles();

            $user->setRoles($roles);
            $this->userRepository->add($user);
        }
    }
    public function getUserRepository(){
        return $this->userRepository;
    }
  

    //Interactor tests
    /**
     * Method to create a user with an interactor
     * @param array $data Userdata
     */
    public function create(array $data) {
        foreach ($data as $row) {
            $request = new UserCreateRequest($row['username'], $row['password'], $row['email'], $row['password_confirm'], $row['email_confirm'], 'Guest');
        }

        $interactor = new UserCreateInteractor($this->userRepository, $this->roleRepository, $this->userRolesRepository, $this->hasher);
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
            $request = new UserLoginRequest($row['username'], $row['password']);
        }
        $interactor = new UserLoginInteractor($this->userRepository, $this->hasher);

        try {
            $this->response = $interactor($request);
            $authRequest = new UserAuthenticateRequest($this->response->getUser(), 'User');
            $authInteractor = new UserAuthenticateInteractor($this->userRepository, $this->roleRepository, $this->userRolesRepository);
        
            $this->response = $authInteractor($authRequest);
        
        } catch (\Exception $e) {
            $this->exception = $e;
        }
    }

    /**
     * Method to send an Activation Mail with an interactor
     * it use the response of UserCreateInteractor
     */
    public function sendActivationCode() {
        $user = $this->response->getMailView()->getUser();

        $request = new SendActivationMailRequest($this->response->getMailView(), $user->getEmail(), $user->getUsername(), 'Activate Account');
        $interactor = new SendActivationMailInteractor($this->mailer);
        $this->response = $interactor($request);
        assertTrue($this->response->getResult());
    }

    /**
     * Method to activate account and set a role for an active use with an interactor
     * @param array $data Userdata
     */
    public function activateAccount(array $data) {
        foreach ($data as $row) {
            $request = new UserActivateRequest($row['username'], $row['activation_code'], 'User');
        }
        $interactor = new UserActivateInteractor($this->userRepository, $this->roleRepository, $this->userRolesRepository);
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
        assertInstanceOf('\OpenTribes\Core\User\Authenticate\Response', $this->response);

        assertNotNull($this->response->getUser()->getId());
    }

    /**
     * Assert Create Account was successfull
     */
    public function assertIsCreateResponse() {
        assertInstanceOf('\OpenTribes\Core\User\Create\Response', $this->response);
        assertNotNull($this->userRepository->findById($this->response->getUser()->getId()));
    }

    /**
     * Assert an activation code mail was created with an interactor
     */
    public function assertHasActivationCode() {
        $request = new CreateActivationMailRequest($this->response->getUser());
        $interactor = new CreateActivationMailInteractor($this->userRepository, $this->codeGenerator);
        $this->response = $interactor($request);
        assertInstanceOf('\OpenTribes\Core\User\ActivationMail\Create\Response', $this->response);
        assertNotNull($this->response->getMailView()->getUser()->getActivationCode());
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
        $user = $this->response->getUser();
        assertInstanceOf('\OpenTribes\Core\User\Activate\Response', $this->response);
        assertEmpty($user->getActivationCode());
    }

    /**
     * Assert account has role
     * @param String $role Role
     */
    public function assertHasRole($role) {
        $user = $this->response->getUser();
     
        assertTrue($user->getRoles()->hasRole($role));
    }

}

?>
