<?php

namespace Core\DataContainer\Criteria;

use Core\DataContainer\Criteria;
use Core\Exception\DataContainer\Criteria\Smtp\InvalidParameters;

class Smtp extends Criteria {

    protected $to;
    protected $from;
    protected $fromName;
    protected $subject;
    protected $html;
    protected $txt;
    protected static $keyMap = [
        'to'       => 'to',
        'from'     => 'from',
        'fromName' => 'from_name',
        'subject'  => 'subject',
        'txt'      => 'txt',
        'html'     => 'html',
    ];

    public function exchangeArray( $data ) {
        $this->checkData($data);
        parent::exchangeArray($data);
    }

    private function checkData( $data ) {
        $mandatory = [
            'to',
            'from',
            'subject',
            'txt',
            'html',
        ];
        foreach($mandatory as $key){
            if(empty($data[$key])){
                 throw new InvalidParameters($key);
            }
        }
    }

    public function getTo() {
        return $this->to;
    }

    public function getFrom() {
        return $this->from;
    }

    public function getFromName() {
        return $this->fromName;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getHtml() {
        return $this->html;
    }

    public function getTxt() {
        return $this->txt;
    }

}
