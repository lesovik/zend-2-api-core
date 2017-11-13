<?php

namespace CoreTest\Exception\Form\AnnotatedForm;

use Core\Exception\Form\AnnotatedForm as ParentException;
use Core\Exception\Form\AnnotatedForm\MissingKeyMap as Exception;
use PHPUnit\Framework\TestCase;
use Zend\Http\Response;

class MissingKeyMapTest extends TestCase {

    public function testException() {
        $ex = new Exception();
        $this->assertEquals(ParentException::MESSAGE.Exception::MESSAGE,$ex->getMessage());
        $this->assertEquals(Response::STATUS_CODE_500,$ex->getCode());
    }

}
