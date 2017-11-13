<?php

namespace CoreTest\Exception\DataContainer;

use Core\Exception\DataContainer as ParentException;
use Core\Exception\DataContainer\MissingNameParameter as Exception;
use PHPUnit\Framework\TestCase;
use Zend\Http\Response;

class MissingNameParameterTest extends TestCase {

    public function testException() {
        $property = 'property';
        $ex = new Exception($property);
        $this->assertEquals(ParentException::MESSAGE.Exception::MESSAGE.$property,$ex->getMessage());
        $this->assertEquals(Response::STATUS_CODE_500,$ex->getCode());
    }

}
