<?php

namespace OpenTribes\Core\Player\Login;


use OpenTribes\Core\Player\Repository as PlayerRepository;
use OpenTribes\Core\Util\Hasher;
use OpenTribes\Core\Player\Login\Exception\NotExists as PlayerNotFoundException;
use OpenTribes\Core\Player\Login\Exception\Invalid as IncorrectPasswordException;
use OpenTribes\Core\Player\Login\Exception\NotActive as AccountNotActivatedException;

class Interactor {

    private $playerRepository = null;
    private $hasher = null;

    public function __construct(PlayerRepository $playerRepo, Hasher $hasher) {
        $this->playerRepository = $playerRepo;
        $this->hasher = $hasher;
    }

    public function __invoke(Request $request) {
        $password = $this->hasher->hash($request->getPassword());
   
        $player = $this->playerRepository->findByUsername($request->getUsername());
      
        if (!$player) {
            throw new PlayerNotFoundException;
        }
        
        if ((bool) $player->getActivationCode())
            throw new AccountNotActivatedException;
        
      
        if ($player->getPasswordHash() !== $password) {
            throw new IncorrectPasswordException;
        }


        return new Response($player);
    }

}