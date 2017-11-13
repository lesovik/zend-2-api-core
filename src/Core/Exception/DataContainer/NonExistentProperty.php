<?php
namespace Core\Exception\DataContainer;

use Core\Exception\DataContainer;

/**
 * 
 *  NonExistentProperty exception
 *
 * @author Dmitry Lesov
 */
class NonExistentProperty extends DataContainer {

    const MESSAGE = "Property '{property}' does not exist in object '{object}' ";

    public function __construct( $property, $className ) {
        $msg = str_replace('{property}', $property, self::MESSAGE);
        $message = str_replace('{object}', $className, $msg);

        parent::__construct($message);
    }

}
