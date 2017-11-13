<?php

/*
 * ZEND 2 API Common Libraries
 */

namespace Core\Exception\DataContainer\Criteria\Smtp;

use Core\Exception\DataContainer\Criteria as Exception;

/**
 * 
 *  invalid email criteria parameters exception
 *
 * @author Dmitry Lesov
 */
class InvalidParameters extends Exception {

    const MESSAGE = 'Invalid parameters passed to email : "#key#" cannot be empty';

    public function __construct($key) {
        $message=str_replace('#key#', $key, self::MESSAGE);
        parent::__construct($message);
    }

}
