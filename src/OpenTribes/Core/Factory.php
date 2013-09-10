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
 * Factory Interface creates new Entities
 */
interface Factory {

    /**
     * Create an Object of given class from JSON String
     * @param String $json
     * @return \OpenTribes\Core\Entity
     */
    public function createFromJson($json);

    /**
     * Create an Object of given class from Array
     * @param array $data propertiy => value pairs
     * @return \OpenTribes\Core\Entity
     */
    public function createFromArray(array $data);
    /**
     * Create an Object of given class from serialized String
     * @param String $string
     * @return \OpenTribes\Core\Entity
     */
    public function createFromSerializedString($string);
}