<?php
namespace Core\Exception;

use Core\Exception;
use Zend\Http\Response;

/**
 * 
 *  DataContainer exception
 *
 * @author Dmitry Lesov
 */
class DataContainer extends Exception {

    const MESSAGE = "Data Container Failure : ";

    public function __construct( $message = '' ) {
        parent::__construct(self::MESSAGE . $message, Response::STATUS_CODE_500);
    }

}
