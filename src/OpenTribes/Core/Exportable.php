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
/**
 * Abstract Exportable helper , exports an entity to other types
 */
abstract class Exportable{
     /**
      * @return Json $entity exports entity as json object
      */
    public function asJson() {
        return json_encode($this->toArray());
    }
    /**
     * @return Array $entity exports entity as array
     */
    public function asArray() {
        return get_object_vars($this);
    }
    /**
     * @return String $entity exports entity as serialized string
     */
    public function asSerializedString(){
        return serialize($this);
    }
}