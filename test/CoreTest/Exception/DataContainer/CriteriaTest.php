<?php

namespace CoreTest\Exception\DataContainer;

use Core\Exception\DataContainer as ParentException;
use Core\Exception\DataContainer\Criteria as Exception;
use PHPUnit\Framework\TestCase;
use Zend\Http\Response;

class CriteriaTest extends TestCase {

    public function testException() {

        $message = 'test';

        $ex = new Exception($message);


        $this->assertEquals(
            ParentException::MESSAGE . Exception::MESSAGE . $message,
            $ex->getMessage()
        );
        $this->assertEquals(Response::STATUS_CODE_500, $ex->getCode());
    }

}
