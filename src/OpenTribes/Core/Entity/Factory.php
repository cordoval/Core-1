<?php

namespace OpenTribes\Core\Entity;

use OpenTribes\Core\Factory as FactoryInterface;
use OpenTribes\Core\Entity;
class Factory implements FactoryInterface {

    protected $object = NULL;

    public function __construct(Entity $entity){
        $this->object = $entity;
    }

    /**
     * {@inheritdoc}
     */
    public function createFromJson($json) {
        return $this->createFromArray(json_decode($json));
    }

    /**
     * {@inheritdoc}
     */
    public function createFromArray(array $data) {
        if (is_object($this->object)) {
            $object = clone $this->object;
            foreach ($data as $key => $value) {
                $object->{$key} = $value;
            }
            return $object;
        } else {
            throw new \Exception('Cannot create new Object, object is missing');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createFromSerializedString($string) {
        return $this->createFromArray(unserialize($string));
    }

    /**
     * {@inheritdoc}
     */
    public function create() {
        if (is_object($this->object)) {
            return clone $this->object;
        } else {
            throw new \Exception('Cannot create new Object, object is missing');
        }
    }

}