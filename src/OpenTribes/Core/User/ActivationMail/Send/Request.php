<?php

namespace OpenTribes\Core\User\ActivationMail\Send;

class Request{
    protected $mailBody;
    protected $email;
    protected $name;
    protected $subject;
    
    public function __construct($mailBody = null,$email = null,$name = null,$subject = null) {
        $this->setMailBody($mailBody)
                ->setEmail($email)
                ->setName($name)
                ->setSubject($subject);
    }
    public function setMailBody($mailBody){
        $this->mailBody = $mailBody;
        return $this;
    }
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    public function setSubject($subject){
        $this->subject = $subject;
        return $this;
    }

    public function getMailBody(){
        return $this->mailBody;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getName(){
        return $this->name;
    }
    public function getSubject(){
        return $this->subject;
    }
}
