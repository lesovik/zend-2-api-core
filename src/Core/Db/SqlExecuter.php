<?php

namespace Core\Db;

use ArrayObject;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\PreparableSqlInterface;
use Zend\Db\Sql\Sql;

/**
 * Executes Sql objects and mappes them to result set or array
 *
 * @author Dmitry Lesov
 */
class SqlExecuter
{

    /**
     * @var Adapter $dbAdapter
     */
    private $dbAdapter;

    /**
     * injects db adaper as private property
     *
     * @param Adapter $dbAdapter
     */
    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * returns db adapter object
     *
     * @return Adapter
     */
    public function getAdapter()
    {
        return $this->dbAdapter;
    }

    /**
     * returns last generated value in specific sequence
     *
     * @return mixed
     */
    public function getLastGeneratedValue($name)
    {
        return $this->dbAdapter
            ->getDriver()
            ->getConnection()
            ->getLastGeneratedValue($name);
    }

    /**
     *
     *
     * @param PreparableSqlInterface $sqlObject
     * @param ArrayObject $rsp [optional]
     * @param Sql $sql [optional]
     * @return ResultSet
     */
    public function execute(
        PreparableSqlInterface $sqlObject, ArrayObject $rsp = null, Sql $sql = null
    )
    {
        if (!$sql) {
            $sql = new Sql($this->dbAdapter);
        }

        $statement = $sql->prepareStatementForSqlObject($sqlObject);

        $rs = new ResultSet();
        if ($rsp) {
            $rs->setArrayObjectPrototype($rsp);
        }
        return $rs->initialize($statement->execute());
    }

}
