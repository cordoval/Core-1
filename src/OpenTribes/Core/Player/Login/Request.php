<?php

namespace OpenTribes\Core\Player\Login;

class Request {

    protected $_username;
    protected $_password;
    

    public function __construct($username = null, $password = null) {
        $this->setUsername($username)
                ->setPassword($password);
    }

    public function setPassword($password) {
        $this->_password = $password;
        return $this;
    }

    public function setUsername($username) {
        $this->_username = $username;
        return $this;
    }



    public function getPassword() {
        return $this->_password;
    }

    public function getUsername() {
        return $this->_username;
    }

  

}
