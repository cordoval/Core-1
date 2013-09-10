<?php

namespace OpenTribes\Core\Player\ActivationMail\Send;

use OpenTribes\Core\Util\Mailer;
class Interactor{
    protected $_mailer;
    public function __construct(Mailer $mailer) {
        $this->_mailer = $mailer;
    }
    public function __invoke(Request $request) {
       
        $this->_mailer->setBody($request->getMailBody());
        $this->_mailer->setRecipient($request->getEmail());
        $this->_mailer->setSubject($request->getSubject());
        
        $result = $this->_mailer->send();
        return new Response($result);
    }
}