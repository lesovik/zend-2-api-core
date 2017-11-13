<?php

namespace CoreTest\Exception\DataContainer;

use Core\Exception\Smtp\SendGrid as Exception;
use PHPUnit\Framework\TestCase;
use Zend\Http\Response;

class SendGridTest extends TestCase {

    public function testException() {
        $errors = ['property', 'property'];
        $ex     = new Exception($errors);
        $this->assertEquals(Exception::MESSAGE . implode(' | ',
                $errors), $ex->getMessage()
        );
        $this->assertEquals(Response::STATUS_CODE_500, $ex->getCode());
    }

}
