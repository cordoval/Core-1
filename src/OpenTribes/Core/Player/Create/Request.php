<?php

namespace OpenTribes\Core\Player\Create;

class Request {

    protected $_username;
    protected $_passwordConfirm;
    protected $_password;
    protected $_email;
    protected $_emailConfirm;

    public function __construct($username = null, $password = null, $email = null,$passwordConfirm = null,$emailConfirm=null) {
        $this->setUsername($username)
                ->setEmail($email)
                ->setPassword($password)
                ->setEmailConfirm($emailConfirm)
                ->setPasswordConfirm($passwordConfirm);
    }
    public function setPasswordConfirm($passwordConfirm){
        $this->_passwordConfirm = $passwordConfirm;
        return $this;
    }
    public function setEmailConfirm($emailConfirm){
        $this->_emailConfirm = $emailConfirm;
        return $this;
    }

    public function setPassword($password) {
        $this->_password = $password;
        return $this;
    }

    public function setUsername($username) {
        $this->_username = $username;
        return $this;
    }

    public function setEmail($email) {
        $this->_email = $email;
        return $this;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function getUsername() {
        return $this->_username;
    }

    public function getEmail() {
        return $this->_email;
    }
    public function getPasswordConfirm(){
        return $this->_passwordConfirm;
    }
    public function getEmailConfirm(){
        return $this->_emailConfirm;
    }
}
