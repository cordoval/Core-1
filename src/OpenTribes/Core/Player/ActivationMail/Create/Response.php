<?php

namespace OpenTribes\Core\Player\ActivationMail\Create;

use OpenTribes\Core\Player\ActivationMail;

class Response {

    protected $_mailView;


    public function __construct(ActivationMail $mailView) {
        $this->setMailView($mailView);
    }

    public function setMailView(ActivationMail $mailView) {
        $this->_mailView = $mailView;
        return $this;
    }

    public function getMailView() {
        return $this->_mailView;
    }

}