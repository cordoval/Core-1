<?php

namespace OpenTribes\Core\Player\ActivationMail\Create;

use OpenTribes\Core\Player\Repository as PlayerRepository;
use OpenTribes\Core\Util\CodeGenerator;
use OpenTribes\Core\Player\ActivationMail\View\Mail;

class Interactor{
    protected $_playerRepository;
    protected $_codeGenerator;
    
    public function __construct(PlayerRepository $playerRepository,  CodeGenerator $codeGenerator){
        $this->_playerRepository = $playerRepository;
        $this->_codeGenerator = $codeGenerator;
    }
    public function __invoke(Request $request) {
        $code = $this->_codeGenerator->create();
        $player = $request->getPlayer();
        $player->setActivationCode($code);
        $this->_playerRepository->save($player);
        
        
        return new Response(new Mail($player));
    }
}
