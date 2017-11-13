<?php

namespace CoreTest\Form;

use Core\Exception;
use Core\DataContainer;
use Core\Form\DataValidator;
use PHPUnit\Framework\TestCase;

class DataValidatorTest extends TestCase {

    public function dataSets() {
        return [
            [
                [ //valid data
                    'first_name' => 'more than ten',
                    'email'      => 'dlesov@gmail.com'
                ],
                true,
                null
            ],
            [
                [   //empty data
                    'first_name' => '',
                    'email'      => ''
                ],
                false,
                null
            ],
            [
                [   //invalid data
                    'first_name' => 'ewr',
                    'email'      => 'ewrwerewr'
                ],
                false,
                null
            ],
            [
                [   //invalid data
                    'first_name' => 'ewr',
                    'email'      => 'ewrwerewr'
                ],
                false,
                'MissingKeyMap'
            ],
        ];
    }

    /**
     * @dataProvider dataSets
     * @param Array $data
     * @param bool $isValid
     * @param string $expected
     */
    public function testValidator( $data, $isValid, $expected ) {
        $dummyContainer = new DummyContainer();
        if ( $expected == 'MissingKeyMap' ) {
            $this->expectException('Core\Exception\Form\AnnotatedForm\MissingKeyMap');
            $dummyContainer = new NoKeyMap();
        }

        $form = new DataValidator();
        $form->setUp($dummyContainer);
        $form->setData($data);
        
        $map  = $dummyContainer->getKeyMap();

        foreach ($map as $val) {
            $fieldName = (is_array($val)) ? $val['name'] : $val;
            $this->assertTrue($form->has($fieldName));
        }
        $valids = [
            'EmailAddress' => 'emailAddressInvalidFormat',
            'StringLength' => 'stringLengthTooShort',
        ];

        if ( $isValid ) {
            $this->assertTrue($form->isValid());
        } else {
            $this->assertFalse($form->isValid());
            $messages = $form->getMessages();

            foreach ($map as $mapKey => $attributes) {
                $this->assertArrayHasKey($attributes['name'], $messages);
                if ( !empty($data[$attributes['name']]) ) {
                    foreach ($attributes['validators'] as $key => $validator) {
                        $this->assertArrayHasKey(
                            $valids[$validator['name']],
                            $messages[$attributes['name']]
                        );
                        $this->assertEquals(
                            $validator['options']['message'],
                            $messages[$attributes['name']][$valids[$validator['name']]]
                        );
                    }
                } else {
                    $this->assertArrayHasKey('isEmpty',
                        $messages[$attributes['name']]);
                }
            }
        }
    }

}

class DummyContainer extends DataContainer {

    protected $theEmail;
    protected $theName;
    protected static $keyMap = [
        'theEmail' => [
            'name'       => 'email',
            'required'   => true,
            'validators' =>
            [
                [
                    'name'    => 'EmailAddress',
                    'options' => [
                        'domain'   => 'true',
                        'hostname' => 'true',
                        'mx'       => 'true',
                        'deep'     => 'true',
                        'message'  => 'EmailAffdsffsddress',
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min'     => '10',
                        'message' => 'StringsfdsfsdfdsfsdLength',
                    ],
                ],
            ],
        ],
        'theName'  => [
            'name'       => 'first_name',
            'required'   => true,
            'validators' =>
            [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min'     => '10',
                        'message' => 'SdsfdsfdsftringLength',
                    ],
                ],
            ],
        ]
    ];

}

class NoKeyMap extends DataContainer {

    protected $first_name;
    protected $email;

}
