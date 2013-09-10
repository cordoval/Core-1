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

    private $playerRepository = null;
    private $rolesRepository = null;
    private $hasher = null;

    public function __construct(PlayerRepository $playerRepo, RolesRepository $rolesRepo, Hasher $hasher) {
        $this->playerRepository = $playerRepo;
        $this->rolesRepository = $rolesRepo;
        $this->hasher = $hasher;
    }

    public function __invoke(Request $request) {

        $password_hashed = $this->hasher->hash($request->getPassword());
        $player = $this->playerRepository->create();
        $player->setPassword($request->getPassword());
        $player->setUsername($request->getUsername());
        $player->setEmail($request->getEmail());

        if ($this->playerRepository->findByUsername($request->getUsername()))
            throw new UsernameExistsException;
        if ($this->playerRepository->findByEmail($request->getEmail()))
            throw new EmailExistsException;

        if ($request->getEmail() !== $request->getEmailConfirm())
            throw new EmailConfirmException;
        if ($request->getPassword() !== $request->getPasswordConfirm())
            throw new PasswordConfirmException;

        $player->setPassword($password_hashed);

        $this->playerRepository->save($player);
        
        return new Response($player);
    }

}