<?php

namespace OpenTribes\Core\Player\Login;

use OpenTribes\Core\Player\Repository as PlayerRepository;
use OpenTribes\Core\Player\Roles\Repository as RolesRepository;
use OpenTribes\Core\Util\Hasher;
use OpenTribes\Core\Player\Login\Exception\PlayerNotFound as PlayerNotFoundException;
use OpenTribes\Core\Player\Login\Exception\IncorrectPassword as IncorrectPasswordException;

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
        $player = $this->_playerRepository->findByUsername($request->getUsername());
   
        if (!$player) {
            throw new PlayerNotFoundException();
        }

        if ($player->getPassword() !== $password) {
            throw new IncorrectPasswordException();
        }


        return new Response($player);
    }

}