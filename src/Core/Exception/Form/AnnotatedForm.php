<?php

/*
 * ZEND 2 API Common Libraries
 */

namespace Core\Exception\Form;

use Core\Exception;

/**
 * 
 *  AnnotatedForm exception
 *
 * @author Dmitry Lesov
 */
class AnnotatedForm extends Exception {

    const MESSAGE = "Annotated Form Failure : ";

    public function __construct( $message , $code = 0 ) {
        parent::__construct( self::MESSAGE.$message,$code );
    }

}
