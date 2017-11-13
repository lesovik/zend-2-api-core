<?php

namespace CoreTest\Exception\DataContainer\Criteria\Smtp;

use Core\Exception\DataContainer as DCException;
use Core\Exception\DataContainer\Criteria as CException;
use Core\Exception\DataContainer\Criteria\Smtp\InvalidParameters as Exception;
use PHPUnit\Framework\TestCase;
use Zend\Http\Response;

class InvalidParametersTest extends TestCase {

    public function testException() {

        $message = 'test';

        $ex = new Exception($message);

        $expected = str_replace("#key#", $message, Exception::MESSAGE);
        $this->assertEquals(
            DCException::MESSAGE . CException::MESSAGE . $expected,
            $ex->getMessage()
        );
        $this->assertEquals(Response::STATUS_CODE_500, $ex->getCode());
    }

}
