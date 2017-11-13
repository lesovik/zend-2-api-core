<?php

namespace Core\Exception\Smtp;

use Core\Exception\Smtp;

class SendGrid extends Smtp {

    public function __construct($errors) {
        parent::__construct(implode(' | ', $errors));
    }

}
