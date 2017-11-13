<?php

namespace CoreTest;

use Core\DataContainer;
use PHPUnit\Framework\TestCase;

class DataContainerTest extends TestCase {

    public function mappedDataSets() {
        $data = [
            'test_1'  => 'cccc',
            'test_2'  => 'frcccom',
            'test_3'  => 'fromccc_name',
            'test232' => 'subcccject',
        ];
        return [
            [
                $data,
                true,
                'ValidMappedContainer'
            ],
            [
                $data,
                true,
                'ValidMappedContainerName'
            ],
            [
                $data,
                false,
                'MissingNameParameter'
            ],
            [
                $data,
                false,
                'NonExistentProperty'
            ],
        ];
    }

    /**
     * @dataProvider mappedDataSets
     * @param Array $data
     * @param bool $isValid
     * @param string $expected
     */
    public function testMappedContainer( $data, $isValid, $expected ) {
        if ( !$isValid ) {
            $this->expectException('Core\Exception\DataContainer\\' . $expected);
        }
        $class     = "CoreTest\\" . $expected;
        $container = new $class($data);
        $actual    = $container->getArrayCopy();
        ksort($data);
        ksort($actual);
        $this->assertEquals($data, $actual);
    }

    public function unmappedDataSets() {
        $data = [
            'test_1'  => 'cccc',
            'test_2'  => 'frcccom',
            'test_3'  => 'fromccc_name',
            'test232' => 'subcccject',
        ];
        return [
            [
                $data,
                true,
                'Valid'
            ],
            [
                $data,
                false,
                'NonExistentProperty'
            ],
        ];
    }

    /**
     * @dataProvider unmappedDataSets
     * @param Array $data
     */
    public function testUnmappedContainer( $data, $isValid, $expected ) {
        if ( !$isValid ) {
            $this->expectException('Core\Exception\DataContainer\\' . $expected);
        }
        $name="CoreTest\Unmapped".$expected;
        $container = new $name($data);
        $actual    = $container->getArrayCopy();
        ksort($data);
        ksort($actual);
        $this->assertEquals($data, $actual);
    }

}

class ValidMappedContainer extends DataContainer {

    protected $testOne;
    protected $testTwo;
    protected $testThree;
    protected $testFour;
    protected static $keyMap = [
        'testOne'   => 'test_1',
        'testTwo'   => 'test_2',
        'testThree' => 'test_3',
        'testFour'  => 'test232',
    ];

}

class ValidMappedContainerName extends DataContainer {

    protected $testOne;
    protected $testTwo;
    protected $testThree;
    protected $testFour;
    protected static $keyMap = [
        'testOne'   => 'test_1',
        'testTwo'   => ['name'=>'test_2'],
        'testThree' => 'test_3',
        'testFour'  => 'test232',
    ];

}

class NonExistentProperty extends DataContainer {

    protected $testOne;
    protected $testTwo;
    protected $testFour;
    protected static $keyMap = [
        'testOne'   => 'test_1',
        'testTwo'   => 'test_2',
        'testThree' => 'test_3',
        'testFour'  => 'test232',
    ];

}

class MissingNameParameter extends DataContainer {

    protected $testOne;
    protected $testTwo;
    protected $testFour;
    protected static $keyMap = [
        'testOne'   => 'test_1',
        'testTwo'   => ['test_2'],
        'testThree' => 'test_3',
        'testFour'  => 'test232',
    ];

}

class UnmappedValid extends DataContainer {

    protected $test_1;
    protected $test_2;
    protected $test_3;
    protected $test232;

}
class UnmappedNonExistentProperty extends DataContainer {

    protected $test_1;
    protected $test_2;
    protected $test232;

}
