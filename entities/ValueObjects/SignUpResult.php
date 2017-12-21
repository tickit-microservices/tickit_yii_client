<?php

namespace app\entities\ValueObjects;

use yii\base\Object;

class SignUpResult extends Object
{
    public $success = false;

    public $message = '';
}