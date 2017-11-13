<?php

/*
 * ZEND 2 API Common Libraries
 */

namespace Core\Exception\Form\AnnotatedForm;

use Zend\Http\Response;
use Core\Exception\Form\AnnotatedForm;

/**
 * 
 *  MissingKeyMap exception
 *
 * @author Dmitry Lesov
 */
class MissingKeyMap extends AnnotatedForm {

    const MESSAGE = "Key Map is missing from passed object";

    public function __construct() {
        parent::__construct( self::MESSAGE, Response::STATUS_CODE_500 );
    }

}
