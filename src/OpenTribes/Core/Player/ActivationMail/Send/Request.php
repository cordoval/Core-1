<?php

namespace OpenTribes\Core\Player\ActivationMail\Send;

class Request{
    protected $_mailBody;
    protected $_email;
    protected $_name;
    protected $_subject;
    
    public function __construct($mailBody = null,$email = null,$name = null,$subject = null) {
        $this->setMailBody($mailBody)
                ->setEmail($email)
                ->setName($name)
                ->setSubject($subject);
    }
    public function setMailBody($mailBody){
        $this->_mailBody = $mailBody;
        return $this;
    }
    public function setEmail($email){
        $this->_email = $email;
        return $this;
    }
    public function setName($name){
        $this->_name = $name;
        return $this;
    }
    public function setSubject($subject){
        $this->_subject = $subject;
        return $this;
    }

    public function getMailBody(){
        return $this->_mailBody;
    }
    public function getEmail(){
        return $this->_email;
    }
    public function getName(){
        return $this->_name;
    }
    public function getSubject(){
        return $this->_subject;
    }
}
