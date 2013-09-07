<?php

namespace OpenTribes\Core\Entity;

use OpenTribes\Core\Factory as BaseFactory;

abstract class Factory implements BaseFactory {

    protected $object = NULL;

    abstract public function __construct();

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
        return unserialize($string);
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