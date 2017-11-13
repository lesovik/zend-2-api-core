<?php

/*
 * ZEND 2 API Common Libraries
 */

namespace Core\Exception;

use Core\Exception;
use Zend\Http\Response;

/**
 * 
 *  DataContainer exception
 *
 * @author Dmitry Lesov
 */
class Smtp extends Exception {

    const MESSAGE = "SMTP Failure : ";

    public function __construct( $message ) {
        parent::__construct(self::MESSAGE . $message, Response::STATUS_CODE_500);
    }

}
