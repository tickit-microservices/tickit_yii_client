<?php

namespace app\entities\models;

class Project extends BaseModel
{
    /**
     * @var Tick[]
     */
    public $ticks;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;
}