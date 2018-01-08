<?php

namespace app\entities\models;

class Tick extends BaseModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $projectId;

    /**
     * @var string
     */
    public $created;

    /**
     * @var User
     */
    public $user;

    /**
     * @var User
     */
    public $createdByUser;
}