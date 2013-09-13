<?php

namespace OpenTribes\Core\User\Create;

class Request {

    protected $username;
    protected $passwordConfirm;
    protected $password;
    protected $email;
    protected $emailConfirm;
    protected $rolename;
    public function __construct($username = null, $password = null, $email = null,$passwordConfirm = null,$emailConfirm=null,$rolename=null) {
        $this->setUsername($username)
                ->setEmail($email)
                ->setPassword($password)
                ->setEmailConfirm($emailConfirm)
                ->setPasswordConfirm($passwordConfirm)
                ->setRoleName($rolename);
    }
    public function setRoleName($rolename){
        $this->rolename = $rolename;
        return $this;
    }

    public function setPasswordConfirm($passwordConfirm){
        $this->passwordConfirm = $passwordConfirm;
        return $this;
    }
    public function setEmailConfirm($emailConfirm){
        $this->emailConfirm = $emailConfirm;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getPasswordConfirm(){
        return $this->passwordConfirm;
    }
    public function getEmailConfirm(){
        return $this->emailConfirm;
    }
    public function getRoleName(){
        return $this->rolename;
    }
}
