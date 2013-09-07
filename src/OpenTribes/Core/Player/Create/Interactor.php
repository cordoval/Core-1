<?php

namespace OpenTribes\Core\Player\Create;

use OpenTribes\Core\Player;
use OpenTribes\Core\Player\Repository as PlayerRepository;
use OpenTribes\Core\Player\Roles\Repository as RolesRepository;
use OpenTribes\Core\Util\Hasher;
use OpenTribes\Core\Player\Create\Exception\Email\Exists as EmailExistsException;
use OpenTribes\Core\Player\Create\Exception\Email\Confirm as EmailConfirmException;
use OpenTribes\Core\Player\Create\Exception\Username\Exists as UsernameExistsException;
use OpenTribes\Core\Player\Create\Exception\Password\Confirm as PasswordConfirmException;

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

        $password_hashed = $this->_hasher->hash($request->getPassword());
        $player = new Player();
        $player->setPassword($request->getPassword());
        $player->setUsername($request->getUsername());
        $player->setEmail($request->getEmail());

        if ($this->_playerRepository->findByUsername($request->getUsername()))
            throw new UsernameExistsException;
        if ($this->_playerRepository->findByEmail($request->getEmail()))
            throw new EmailExistsException;

        if ($request->getEmail() !== $request->getEmailConfirm())
            throw new EmailConfirmException;
        if ($request->getPassword() !== $request->getPasswordConfirm())
            throw new PasswordConfirmException;

        $player->setPassword($password_hashed);

        $this->_playerRepository->save($player);

        return new Response($player);
    }

}