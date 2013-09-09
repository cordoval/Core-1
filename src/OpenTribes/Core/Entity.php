<?php
/*
* This file is part of the "Open Tribes" Core Module.
*
* @package    OpenTribes\Core
* @author     Witali Mik <mik@blackscorp.de>
* @copyright  (c) 2013 BlackScorp Games
* @license    For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
*/
namespace OpenTribes\Core;
use OpenTribes\Core\Entity\Exception\UnknownProperty as UnknownPropertyException;
/**
 * A Basic Entity class
 * 
 * contains magic __get and __set methods to call getAttribute / setAttribute
 * 
 */
abstract class Entity extends Exportable{

    /**
     * Entity ID
     * @var Int $id 
     */
    protected $id = 0;

    /**
     * Entity Name
     * @var String $name 
     */
    protected $name = '';

    /**
     * @param String $name
     * @return mixed $value
     * @throws UnknownPropertyException 
     */
    public function __get($name) {
        $method = 'get' . $name;
        if (method_exists($this, $method)) {
            return $this->{$method};
        } else {
            throw new UnknownPropertyException(sprintf("Cannot get unknown property '%s' in class %s", $name, get_class($this)));
        }
    }

    /**
     * @return Int $id Entity ID
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return String $name Entity Name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param String $name
     * @param Mixed $value
     * @throws UnknownPropertyException 
     */
    public function __set($name, $value) {
        $method = 'set' . $name;
        if (method_exists($this, $method)) {
            $this->{$method}($value);
        } else {
            throw new UnknownPropertyException(sprintf("Cannot set unknown property '%s' in class %s", $name, get_class($this)));
        }
    }

    /**
     * @param Int $id
     * @return Entity method chain
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param String $name
     * @return Entity method chain
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

  


}