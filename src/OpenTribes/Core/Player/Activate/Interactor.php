<?php

namespace OpenTribes\Core\Player\Activate;

use OpenTribes\Core\Player\Repository as PlayerRepository;
use OpenTribes\Core\Player\Roles\Repository as PlayerRolesRepository;
use OpenTribes\Core\Role\Repository as RoleRepository;

use OpenTribes\Core\Player\Roles as PlayerRoles;

use OpenTribes\Core\Player\Activate\Exception\NotExists as NotExistsException;
use OpenTribes\Core\Player\Activate\Exception\Invalid as InvalidCodeException;
use OpenTribes\Core\Player\Activate\Exception\Active as AlreadyActiveException;

use OpenTribes\Core\Interactor as BaseInteractor;

class Interactor extends BaseInteractor {

    protected $playerRepository;
    protected $playerRoleRepository;
    protected $roleRepository;

    public function __construct(PlayerRepository $playerRepository, RoleRepository $roleRepository, PlayerRolesRepository $playerRolesRepository) {
        $this->playerRepository = $playerRepository;
        $this->playerRoleRepository = $playerRolesRepository;
        $this->roleRepository = $roleRepository;
    }

    public function __invoke(Request $request) {
        $player = $this->playerRepository->findByUsername($request->getUsername());
       
        $role = $this->roleRepository->findByName($request->getRolename());
        if (!$player)
            throw new NotExistsException;
        if (!((bool) $player->getActivationCode()))
            throw new AlreadyActiveException;
        if ($player->getActivationCode() !== $request->getCode())
            throw new InvalidCodeException;

        $player->setActivationCode('');
        $roles = new PlayerRoles();
        $roles->addRole($role);

        $player->setRoles($roles);

        $this->playerRepository->add($player);
        $this->playerRoleRepository->add($roles);

        return new Response($player);
    }

}