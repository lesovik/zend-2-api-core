<?php

namespace Core;

use ArrayIterator;
use Core\Exception\DataContainer as Ex;

/**
 *
 *  DataContainer - mapped storage object
 *
 * @author Dmitry Lesov
 */
class DataContainer extends \ArrayObject
{

    /**
     * sets up properties
     *
     * parent __construct is not called since it will make properties public
     *
     * @param array $data | null
     */
    public function __construct(array $data = null)
    {
        if ($data !== null) {
            $this->exchangeArray($data);
        }
    }

    /**
     * returns iterator converted to array
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return iterator_to_array($this->getIterator());
    }

    /**
     * maps property values into iterator keys based on keymap if it exists
     * and based on class vars otherwise
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        $class = get_class($this);
        $vars = get_class_vars($class);
        $keys = array_keys($vars);

        $result = [];
        if (!empty($this::$keyMap) && is_array($this::$keyMap)) {
            foreach ($keys as $key) {
                if ($key != 'keyMap' && !empty($this::$keyMap[$key])) {
                    $keyName = (is_array($this::$keyMap[$key]))
                        ? $this::$keyMap[$key]['name']
                        : $this::$keyMap[$key];
                    $result[$keyName] = $this->$key;

                }
            }
        } else {
            foreach ($keys as $name) {
                $result[$name] = $this->$name;
            }
        }

        return new ArrayIterator($result);
    }

    /**
     * parent::exchangeArray override
     *
     *
     * @param array $data
     * @return void
     */
    public function exchangeArray($data)
    {

        if (empty($this::$keyMap) || !is_array($this::$keyMap)) {
            $this->exchangeArrayUnmapped($data);
        } else {
            $this->exchangeArrayMapped($data);
        }
    }

    /**
     * maps properties based on keymap
     *
     * @throws Ex\NonExistentProperty
     * @throws Ex\MissingNameParameter
     * @param array $data
     */
    private function exchangeArrayMapped($data)
    {
        foreach ($this::$keyMap as $property => $attributes) {
            if (!property_exists($this, $property)) {
                throw new Ex\NonExistentProperty(
                    $property, get_class($this)
                );
            }
            if (is_array($attributes) && empty($attributes['name'])) {
                throw new Ex\MissingNameParameter($property);
            }

            $key = (is_array($attributes)) ? $attributes['name'] : $attributes;
            if (
                !empty($data[$key]) ||
                (
                    array_key_exists($key, $data) && $data[$key] === false
                )
            ) {
                $this->$property = $data[$key];
            }
        }
    }

    /**
     * maps properties based on passed associative array
     *
     * @throws Ex\NonExistentProperty
     * @param array $data
     */
    private function exchangeArrayUnmapped($data)
    {
        foreach ($data as $property => $value) {
            if (!property_exists($this, $property)) {
                throw new Ex\NonExistentProperty(
                    $property, get_class($this)
                );
            }
            $this->$property = ($value) ?: $this->$property;
        }
    }

    /**
     * @return array
     */
    public function getKeyMap()
    {
        $keyMap = [];
        if (!empty($this::$keyMap)) {
            $keyMap = $this::$keyMap;
        }
        return $keyMap;
    }

}
