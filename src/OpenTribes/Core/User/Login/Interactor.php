<?php

namespace OpenTribes\Core\User\Login;


use OpenTribes\Core\User\Repository as UserRepository;
use OpenTribes\Core\Util\Hasher;
use OpenTribes\Core\User\Login\Exception\NotExists as UserNotFoundException;
use OpenTribes\Core\User\Login\Exception\Invalid as IncorrectPasswordException;
use OpenTribes\Core\User\Login\Exception\NotActive as AccountNotActivatedException;

class Interactor {

    private $userRepository = null;
    private $hasher = null;

    public function __construct(UserRepository $userRepo, Hasher $hasher) {
        $this->userRepository = $userRepo;
        $this->hasher = $hasher;
    }

    public function __invoke(Request $request) {
        $password = $this->hasher->hash($request->getPassword());
   
        $player = $this->userRepository->findByUsername($request->getUsername());
      
        if (!$player) {
            throw new UserNotFoundException;
        }
        
        if ((bool) $player->getActivationCode())
            throw new AccountNotActivatedException;
        
      
        if ($player->getPasswordHash() !== $password) {
            throw new IncorrectPasswordException;
        }


        return new Response($player);
    }

}