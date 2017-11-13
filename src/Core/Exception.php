<?php

/*
 * ZEND 2 API Common Libraries
 */

namespace Core;

use Exception as PhpException;

/**
 * 
 *  Exception abstraction 
 *
 * @author Dmitry Lesov
 */
class Exception extends PhpException {

    /**
     * 
     *  sets $code as optional param defaulting to 0
     *
     * @param string $message 
     * @param int $code
     * @param $previous
     */
    public function __construct( $message, $code = 0, $previous = null ) {
        parent::__construct($message, $code, $previous);
    }

}
