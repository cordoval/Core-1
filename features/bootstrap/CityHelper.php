<?php


use OpenTribes\Core\City;
use OpenTribes\Core\City\Mock\Repository as CityRepository;
use OpenTribes\Core\User\Mock\Repository as UserRepository;


require_once 'vendor/phpunit/phpunit/PHPUnit/Framework/Assert/Functions.php';

class CityHelper {
    protected $mapHelper;
    protected $userRepository;
    protected $cityRepository;
    protected $user;
    public function __construct(){
        $this->mapHelper = new MapHelper();
        $this->cityRepository = new CityRepository();
    }
    public function getMapHelper(){
        return $this->mapHelper;
    }

    public function setUserRepository(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function createCities(array $cities){
        foreach($cities as $row){
            $city = new City();
            $user = $this->userRepository->findByUsername($row['owner']);
            $city->setX($row['x']);
            $city->setY($row['y']);
            $city->setOwner($user);
            $this->cityRepository->add($city);
        }
    }
    public function iamUser($username){
        $this->user = $this->userRepository->findByUsername($username);
    }
    
    public function create($x,$y){
        
    }
}