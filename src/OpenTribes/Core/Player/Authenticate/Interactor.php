<?php

namespace OpenTribes\Core\Player\Authenticate;

use OpenTribes\Role\Repository as RoleRepository;
use OpenTribes\Player\Repository as PlayerRepository;
use OpenTribes\Player\Roles\Repository as PlayerRolesRepository;
use OpenTribes\Player\Roles as PlayerRoles;
class Interactor{
    protected $roleRepository;
    protected $playerRoleRepository;
    protected $playerRepository;
    public function __construct(PlayerRepository $playerRepository,RoleRepository $roleRepository,PlayerRolesRepository $playerRoleRepository ) {
      $this->playerRepository = $playerRepository;
      $this->roleRepository = $roleRepository;
      $this->playerRoleRepository = $playerRoleRepository;
    }
    public function __invoke(Request $request) {
        $player = $request->getPlayer();

        $role = $this->roleRepository->findByName($request->getRoleName());
        $playerRoles = new PlayerRoles();
        $playerRoles->addRole($role);
        $player->setRoles($playerRoles);
        
        $this->playerRepository->add($player);
        $this->playerRoleRepository->add($playerRoles);
        return new Response($player);
    }
}