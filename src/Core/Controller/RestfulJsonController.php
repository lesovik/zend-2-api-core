<?php

namespace Core\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Http\Response;
use Core\Exception;

/**
 *
 *  Override AbstractRestfulController actions as they do not return valid JsonModels
 *
 * @author Dmitry Lesov
 */
class RestfulJsonController extends AbstractRestfulController
{
    protected function methodNotAllowed($method)
    {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_405);
        throw new Exception("JSON REST Controller Method '{$method}' Not Allowed");
    }

    # Override default actions as they do not return valid JsonModels
    public function create($data)
    {
        return $this->methodNotAllowed(__FUNCTION__);
    }

    public function delete($id)
    {

        return $this->methodNotAllowed(__FUNCTION__);
    }

    public function deleteList($data)
    {
        return $this->methodNotAllowed(__FUNCTION__);
    }

    public function get($id)
    {
        return $this->methodNotAllowed(__FUNCTION__);
    }

    public function getList()
    {
        return $this->methodNotAllowed(__FUNCTION__);
    }

    public function head($id = null)
    {
        return $this->methodNotAllowed(__FUNCTION__);
    }

    public function options()
    {
        return $this->methodNotAllowed(__FUNCTION__);
    }

    public function patch($id, $data)
    {
        return $this->methodNotAllowed(__FUNCTION__);
    }

    public function replaceList($data)
    {
        return $this->methodNotAllowed(__FUNCTION__);
    }

    public function patchList($data)
    {
        return $this->methodNotAllowed(__FUNCTION__);
    }

    public function update($id, $data)
    {
        return $this->methodNotAllowed(__FUNCTION__);
    }
}
