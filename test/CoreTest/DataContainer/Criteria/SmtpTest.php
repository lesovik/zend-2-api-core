<?php
namespace CoreTest\DataContainer\Criteria;
use Core\DataContainer\Criteria\Smtp;
use PHPUnit\Framework\TestCase;

class SmtpTest extends TestCase {

    public function dataSets() {
        return 
        [
            [
                [
                    'to'        => 'cccc',
                    'from'      => 'frcccom',
                    'from_name' => 'fromccc_name',
                    'subject'   => 'subcccject',
                    'txt'       => 'txccct',
                    'html'      => 'htcccml',
                ],
                true
            ],
            [
                [
                    'username' => 'testuser',
                    'password' => 'asdsadas'
                ],
                false
            ],
        ];
    }

    /**
     * @dataProvider dataSets
     * @param Array $data
     * @param bool $isValid
     */
    public function testContainer( $data, $isValid ) {
        if (!$isValid) {
            $this->expectException('Core\Exception\DataContainer\Criteria\Smtp\InvalidParameters');
        }
        $criteria = new Smtp($data);
        ksort($data);
        $actual   = $criteria->getArrayCopy();
        ksort($actual);
        $this->assertEquals($data, $actual);
    }

}
