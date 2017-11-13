<?php

/*
 * ZEND 2 API Common Libraries
 */

namespace Core\Exception\DataContainer;

use Core\Exception\DataContainer as Exception;
/**
 * 
 *  DataContainer Criteria exception
 *
 * @author Dmitry Lesov
 */
class Criteria extends Exception {

    const MESSAGE = "Criteria Failure : ";

    public function __construct( $message = '' ) {
        parent::__construct(self::MESSAGE . $message);
    }

}
