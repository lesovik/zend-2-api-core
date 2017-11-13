<?php

namespace CoreTest\Db;

use Core\DataContainer;
use Core\Db\SqlExecuter;
use PHPUnit\Framework\TestCase;
use PDOStatement;

use Zend\Db\Adapter\Driver\Pdo\Result;

class SqlExecuterTest extends TestCase {

    var $mockAdapter;
    var $mockSql;
    var $executer;

    protected function setUp() {

        $this->mockAdapter = $this->getMockBuilder('Zend\Db\Adapter\Adapter')
            ->disableOriginalConstructor()
            ->setMethods(['getDriver'])
            ->getMock();
        $this->mockSql = $this->getMockBuilder('Zend\Db\Sql\Sql')
            ->disableOriginalConstructor()
            ->setMethods(['prepareStatementForSqlObject'])
            ->getMock();
        $this->executer = new SqlExecuter(
            $this->mockAdapter
        );
    }

    public function testExecute() {
        
       
        $pdoResult=new Result();
        $pdoResult->initialize(new MockPDO(), '$generatedValue');
       
        $mockStatement=$this->getMockBuilder('Zend\Db\Adapter\Driver\Pdo\Statement')
            ->disableOriginalConstructor()
            ->setMethods(['execute'])
            ->getMock();
        $mockStatement->expects($this->at(0))
            ->method('execute')
            ->will($this->returnValue($pdoResult));
        $mockSqlObject=$this->getMockBuilder('Zend\Db\Sql\PreparableSqlInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $this->mockSql->expects($this->at(0))
            ->method('prepareStatementForSqlObject')
            ->will($this->returnValue($mockStatement));
        $rs=$this->executer->execute($mockSqlObject,new Dummy(),$this->mockSql);
        $this->assertInstanceOf('Zend\Db\ResultSet\ResultSet', $rs);
        $this->assertInstanceOf('CoreTest\Db\Dummy', $rs->getArrayObjectPrototype());
    }
    public function testLastGeneratedValue() {
       
        $mockConnection=$this->getMockBuilder('Zend\Db\Adapter\Driver\Pgsql\Pgsql\Connection')
            ->disableOriginalConstructor()
            ->setMethods(['getLastGeneratedValue'])
            ->getMock();
         $mockDriver=$this->getMockBuilder('Zend\Db\Adapter\Driver\Pgsql\Pgsql')
            ->disableOriginalConstructor()
            ->setMethods(['getConnection'])
            ->getMock();
        $mockConnection->expects($this->at(0))
            ->method('getLastGeneratedValue')
            ->will($this->returnValue(1));
        $mockDriver->expects($this->at(0))
            ->method('getConnection')
            ->will($this->returnValue($mockConnection));
        $this->mockAdapter->expects($this->at(0))
            ->method('getDriver')
            ->will($this->returnValue($mockDriver));
    
        $this->assertEquals(1,$this->executer->getLastGeneratedValue('ku'));
    }

}

class Dummy extends DataContainer {

    protected $first_name;
    protected $email;

}
class MockPDO extends PDOStatement
{
    public function __construct ()
    {
    }
    public function rowCount ()
    {
        return 0;
    }

}
