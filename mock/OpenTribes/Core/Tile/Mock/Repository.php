<?php
namespace OpenTribes\Core\Tile\Mock;
use OpenTribes\Core\Entity\Factory;
use OpenTribes\Core\Tile\Repository as RepositoryInterface;
use OpenTribes\Core\Tile;
class Repository implements RepositoryInterface{
    protected $data = array();
    protected $factory;
    public function __construct(Factory $factory){
        $this->factory = $factory;
    }
    public function findById($id){
          if(isset($this->data[$id])) return $this->factory->createFromArray($this->data[$id]);
          return null;
    }
    public function findByName($name){
          foreach ($this->data as $tile) {
            if ($tile['name'] == $name) {
                return $this->factory->createFromArray($tile);
            }
        }
    }
    public function add(Tile $tile) {
        $this->data[$tile->getId()] = $tile->asArray();
    }
    public function create() {
        return $this->factory->create();
    }
}