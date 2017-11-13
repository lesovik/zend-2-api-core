<?php

namespace CoreTest\Exception\Form;

use Core\Exception\Form\AnnotatedForm as Exception;
use PHPUnit\Framework\TestCase;

class AnnotatedFormTest extends TestCase {

    public function testException() {
        $message = 'test message';
        $code = 123;
        $ex = new Exception($message,$code);
        $this->assertEquals(Exception::MESSAGE.$message,$ex->getMessage());
        $this->assertEquals($code,$ex->getCode());
    }

}
