<?php

namespace OpenTribes\Core\Util;

interface Mailer{
    public function setRecipient($recipient);
    public function setBody($body);
    public function setSubject($subject);
    public function getRecipient();
    public function getBody();
    public function getSubject();
    
    public function send();
}
