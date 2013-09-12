<?php

namespace OpenTribes\Core\Player\Authenticate;

use OpenTribes\Core\Role\Repository as RoleRepository;
use OpenTribes\Core\Player\Repository as PlayerRepository;
use OpenTribes\Core\Player\Roles\Repository as PlayerRolesRepository;
use OpenTribes\Core\Player\Roles as PlayerRoles;
use OpenTribes\Core\Player\Authenticate\Exception\Role\NotFound as RoleNotFoundException;
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
        if(!$role)
            throw new RoleNotFoundException;
        
        $playerRoles = new PlayerRoles();
        $playerRoles->addRole($role);
        $player->setRoles($playerRoles);
      
        $this->playerRepository->add($player);
        $this->playerRoleRepository->add($playerRoles);
       
        return new Response($player);
    }
}