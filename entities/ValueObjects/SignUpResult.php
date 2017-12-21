<?php

namespace app\entities\ValueObjects;

use yii\base\BaseObject;

class SignUpResult extends BaseObject
{
    public $success = false;

    public $message = '';
}