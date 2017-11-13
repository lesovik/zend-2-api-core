<?php

namespace CoreTest\Exception\DataContainer;

use Core\Exception\DataContainer as ParentException;
use Core\Exception\DataContainer\NonExistentProperty as Exception;
use PHPUnit\Framework\TestCase;
use Zend\Http\Response;

class NonExistentPropertyTest extends TestCase {

    public function testException() {

        $property = 'property';
        $class    = 'class';

        $ex = new Exception($property, $class);

        $msg     = str_replace('{property}', $property, Exception::MESSAGE);
        $message = str_replace('{object}', $class, $msg);

        $this->assertEquals(
            ParentException::MESSAGE . $message,
            $ex->getMessage()
        );
        $this->assertEquals(Response::STATUS_CODE_500, $ex->getCode());
    }

}
