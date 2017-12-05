<?php
namespace Core\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Core\DataContainer;
use Zend\Db\Adapter\Adapter;
use Zend\Validator\Db\AbstractDb;
use Core\Exception\Form\AnnotatedForm as Exception;


/**
 *
 *  DataContainerValidator
 *
 * @author Dmitry Lesov
 */
class DataValidator extends Form
{

    /** @var  InputFilter */
    protected $inputFilter;
    protected $adapter;

    /**
     *
     *  adds elements to the Zend Form that acts as object input validator
     *  expects DataContainer with keyMap variable defined as array notation Zend form
     *  element declaration. Example:
     'email' => [
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
                        'message'  => 'Invalid email address',
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => '10',
                    ],
                ],
            ],
        ]
     * @throws Exception\MissingKeyMap
     * @param DataContainer $dataContainer
     * @param Adapter $adapter [optional] if not present will throw exception on db hooked validators
     */
    public function setUp( DataContainer $dataContainer, Adapter $adapter = null ) {

        $this->inputFilter = new InputFilter();
        $this->adapter     = $adapter;

        $keyMap = $dataContainer->getKeyMap();
        if ( empty($keyMap) ) {
            throw new Exception\MissingKeyMap();
        }
        foreach ($keyMap as $annotations) {
            if ( is_array($annotations) ) {
                $this->setElement($annotations);
            }
        }
        $this->setInputFilter($this->inputFilter);
    }

    private function setElement( $annotations ) {
        $this->add($annotations);
        $this->inputFilter->add($annotations);
        $validators = $this->inputFilter
            ->get($annotations['name'])
            ->getValidatorChain()
            ->getValidators();
        foreach ($validators as $validator) {
            if ( $validator['instance'] instanceof AbstractDb ) {
                $validator['instance']->setAdapter($this->adapter);
            }
        }
    }

}
