<?php

namespace OpenTribes\Core\Player\Login;

use OpenTribes\Core\Player;
use OpenTribes\Core\Player\Repository as PlayerRepository;
use OpenTribes\Core\Player\Roles\Repository as RolesRepository;
use OpenTribes\Core\Util\Hasher;
use OpenTribes\Core\Player\Login\Exception\NotExists as PlayerNotFoundException;
use OpenTribes\Core\Player\Login\Exception\Invalid as IncorrectPasswordException;
use OpenTribes\Core\Player\Login\Exception\NotActive as AccountNotActivatedException;

class Interactor {

    private $_playerRepository = null;
    private $_rolesRepository = null;
    private $_hasher = null;

    public function __construct(PlayerRepository $playerRepo, RolesRepository $rolesRepo, Hasher $hasher) {
        $this->_playerRepository = $playerRepo;
        $this->_rolesRepository = $rolesRepo;
        $this->_hasher = $hasher;
    }

    public function __invoke(Request $request) {
        $password = $this->_hasher->hash($request->getPassword());
        //Create dummy player to ensure user input
        $dummyPlayer = $this->_playerRepository->create();
        $dummyPlayer->setPassword($request->getPassword());
        $dummyPlayer->setUsername($request->getUsername());
        
        $player = $this->_playerRepository->findByUsername($request->getUsername());
        if (!$player) {
            throw new PlayerNotFoundException;
        }
        
        if ((bool) $player->getActivationCode())
            throw new AccountNotActivatedException;
        
        if ($player->getPassword() !== $password) {
            throw new IncorrectPasswordException;
        }


        return new Response($player);
    }

}