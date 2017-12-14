<?php

namespace app\entities\repositories;

use app\entities\models\User;

interface UserRepositoryInterface
{
    /**
     * @param string $email
     * @param string $password
     *
     * @return User
     */
    public function authenticate(string $email, string $password);
}