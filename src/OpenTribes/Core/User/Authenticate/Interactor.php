<?php

namespace OpenTribes\Core\User\Authenticate;

use OpenTribes\Core\Role\Repository as RoleRepository;
use OpenTribes\Core\User\Repository as UserRepository;
use OpenTribes\Core\User\Roles\Repository as UserRolesRepository;
use OpenTribes\Core\User\Roles as UserRoles;
use OpenTribes\Core\User\Authenticate\Exception\Role\NotFound as RoleNotFoundException;
class Interactor{
    protected $roleRepository;
    protected $userRolesRepository;
    protected $userRepository;
    public function __construct(UserRepository $userRepository,RoleRepository $roleRepository,UserRolesRepository $userRolesRepository ) {
      $this->userRepository = $userRepository;
      $this->roleRepository = $roleRepository;
      $this->userRolesRepository = $userRolesRepository;
    }
    public function __invoke(Request $request) {
        $player = $request->getUser();

        $role = $this->roleRepository->findByName($request->getRoleName());
        if(!$role)
            throw new RoleNotFoundException;
        
        $playerRoles = new UserRoles();
        $playerRoles->addRole($role);
        $player->setRoles($playerRoles);
      
        $this->userRepository->add($player);
        $this->userRolesRepository->add($playerRoles);
       
        return new Response($player);
    }
}