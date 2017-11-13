<?php

namespace CoreTest\Controller;

use Core\Controller\RestfulJsonController;
use PHPUnit\Framework\TestCase;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Core\Exception;

class RestfulJsonControllerTest extends TestCase {

    private $controller;

    public function dataSets() {
        return
            [
                [
                    'create',
                    []
                ],
                [
                    'delete',
                    []
                ],
                [
                    'deleteList',
                ],
                [
                    'get',
                    []
                ],
                [
                    'getList',
                ],
                [
                    'head',
                ],
                [
                    'options',
                ],
                [
                    'create',
                    []
                ],
                [
                    'patch',
                    [],
                    []
                ],
                [
                    'replaceList',
                    []
                ],
                [

                    'patchList',
                    []
                ],
                [
                    'update',
                    [],
                    []
                ],
        ];
    }

    public function setUp() {
        $this->controller = new RestfulJsonController();
    }

    /**
     * @dataProvider dataSets
     * @param string $function
     * @param  $data
     * @param  $id
     */
    public function test( $function, $data = null, $id = null ) {
        $response = new Response();
        $event    = new MvcEvent();
        $event->setResponse($response);
        $this->controller->setEvent($event);


        $this->expectException('Core\Exception');
        $this->controller->$function($data, $id);
    }

}
