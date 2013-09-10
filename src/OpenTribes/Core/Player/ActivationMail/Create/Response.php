<?php

namespace OpenTribes\Core\Player\ActivationMail\Create;

use OpenTribes\Core\Player\ActivationMail\View\Mail;

class Response {

    protected $mailView;


    public function __construct(Mail $mailView) {
        $this->setMailView($mailView);
    }

    public function setMailView(Mail $mailView) {
        $this->mailView = $mailView;
        return $this;
    }

    public function getMailView() {
        return $this->mailView;
    }

}