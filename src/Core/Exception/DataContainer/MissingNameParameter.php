<?php

/*
 * ZEND 2 API Common Libraries
 */

namespace Core\Exception\DataContainer;

use Core\Exception\DataContainer;

/**
 * 
 *  MissingNameParameter exception
 *
 * @author Dmitry Lesov
 */
class MissingNameParameter extends DataContainer {

    const MESSAGE = "Name Parameter is missing from property - ";

    public function __construct( $property ) {
        parent::__construct(self::MESSAGE . $property);
    }

}
