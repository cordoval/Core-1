<?php

namespace OpenTribes\Core\Util\Mock;

use OpenTribes\Core\Util\Mailer;

class Filemailer implements Mailer{
    protected $_body;
    protected $_recipient;
    protected $_subject;
    public function getBody() {
       return $this->_body;
    }
    public function getRecipient() {
        return $this->_recipient;
    }
    public function getSubject() {
        return $this->_subject;
    }
    public function send() {
        return true;
    }
    public function setBody($body) {
        $this->_body = $body;
        return $this;
    }
    public function setRecipient($recipient) {
        $this->_recipient = $recipient;
        return $this;
    }
    public function setSubject($subject) {
        $this->_subject = $subject;
        return $this;
    }
   
}
