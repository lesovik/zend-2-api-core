<?php

namespace Core\Test\PHPUnit\Controller;

use PHPUnit\Framework\ExpectationFailedException;
use Zend\Http\PhpEnvironment\Request;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Dom;

abstract class ControllerTestCase extends AbstractHttpControllerTestCase {

    protected function queryContentContainsAssertion( $path, $match, $useXPath = false ) {
        $result = $this->query($path, $useXPath);
        if ($result->count() == 0) {
            throw new ExpectationFailedException(sprintf(
                'Failed asserting node DENOTED BY %s EXISTS', $path
            ));
        }

        foreach ($result as $node) {
            if ($node->nodeValue == $match) {
                $this->assertEquals($match, $node->nodeValue);
                return;
            }
        }

        throw new ExpectationFailedException(sprintf(
            'Failed asserting node denoted by %s CONTAINS content "%s"', $path,
            $match
        ));
    }

    /**
     * Sets the service manager to return an instance of \Zend\Http\Request
     * instead of it's default.
     */
    protected function setRequestTypeToHttp( $serviceManager ) {
        $serviceManager->setAllowOverride(true);
        $serviceManager->setFactory(
            'Request', function () {
            return new Request();
        });
    }

    public function assertQueryContentContains( $path, $match ) {
        $this->queryContentContainsAssertion($path, $match, false);
    }

    public function assertXpathQueryContentContains( $path, $match ) {
        $this->queryContentContainsAssertion($path, $match, true);
    }

    protected function notQueryContentContainsAssertion( $path, $match, $useXPath = false ) {
        $result = $this->query($path, $useXPath);
        if ($result->count() == 0) {
            throw new ExpectationFailedException(sprintf(
                'Failed asserting node DENOTED BY %s EXISTS', $path
            ));
        }

        foreach ($result as $node) {
            if ($node->nodeValue == $match) {
                throw new ExpectationFailedException(sprintf(
                    'Failed asserting node denoted by %s DOES NOT CONTAIN content "%s"',
                    $path, $match
                ));
            }

            $value = $node->nodeValue;
        }

        $this->assertNotEquals($value, $match);
    }

    public function assertNotQueryContentContains( $path, $match ) {
        $this->notQueryContentContainsAssertion($path, $match, false);
    }

    public function assertNotXpathQueryContentContains( $path, $match ) {
        $this->notQueryContentContainsAssertion($path, $match, true);
    }

    /**
     * Execute a DOM/XPath query
     *
     * @param  string $path
     * @param  bool $useXpath
     * @return array
     */
    protected function query( $path, $useXpath = false ) {
        $response = $this->getResponse();
        $dom      = new Dom\Query($response->getContent());
        if ($useXpath) {
            $dom->registerXpathNamespaces($this->xpathNamespaces);
            return $dom->queryXpath($path);
        }
        return $dom->execute($path);
    }

}
