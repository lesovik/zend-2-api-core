<?php

namespace CoreTest\Exception;

use Core\Exception\DataContainer as Exception;
use PHPUnit\Framework\TestCase;
use Zend\Http\Response;

class DataContainerTest extends TestCase {

    public function testException() {
        $message = 'test message';
        $ex = new Exception($message);
        $this->assertEquals(Exception::MESSAGE.$message,$ex->getMessage());
        $this->assertEquals(Response::STATUS_CODE_500,$ex->getCode());
    }

}
