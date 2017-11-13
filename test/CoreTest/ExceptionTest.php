<?php

namespace CoreTest;

use Core\Exception;
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase {

    public function testException() {
        $message = 'test message';
        $code    = 1;
        $ex = new Exception($message, $code);
        $this->assertEquals($message,$ex->getMessage());
        $this->assertEquals($code,$ex->getCode());
    }

}
