<?php

namespace OpenTribes\Core\User\ActivationMail\Send;

use OpenTribes\Core\Util\Mailer;
class Interactor{
    protected $mailer;
    public function __construct(Mailer $mailer) {
        $this->mailer = $mailer;
    }
    public function __invoke(Request $request) {
       
        $this->mailer->setBody($request->getMailBody());
        $this->mailer->setRecipient($request->getEmail());
        $this->mailer->setSubject($request->getSubject());
        
        $result = $this->mailer->send();
        return new Response($result);
    }
}