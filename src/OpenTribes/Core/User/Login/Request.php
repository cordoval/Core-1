<?php

namespace OpenTribes\Core\User\Login;

class Request {

    protected $username;
    protected $password;
   

    public function __construct($username = null, $password = null) {
        $this->setUsername($username)
                ->setPassword($password);
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }



    public function getPassword() {
        return $this->password;
    }

    public function getUsername() {
        return $this->username;
    }

  

}
