<?php

namespace OpenTribes\Core\Player\ActivationMail\Create;

use OpenTribes\Core\Player\Repository as PlayerRepository;
use OpenTribes\Core\Util\CodeGenerator;
use OpenTribes\Core\Player\ActivationMail\View\Mail;

class Interactor{
    protected $playerRepository;
    protected $codeGenerator;
    
    public function __construct(PlayerRepository $playerRepository,  CodeGenerator $codeGenerator){
        $this->playerRepository = $playerRepository;
        $this->codeGenerator = $codeGenerator;
    }
    public function __invoke(Request $request) {
        $code = $this->codeGenerator->create();
        $player = $request->getPlayer();
        $player->setActivationCode($code);
        $this->playerRepository->save($player);
        
        
        return new Response(new Mail($player));
    }
}
