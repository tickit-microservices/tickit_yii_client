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

    /**
     * Find an user by email
     *
     * @param string $email
     *
     * @return User|null
     */
    public function findByEmail(string $email);

    /**
     * Save an user
     *
     * @param User $user
     *
     * @return User
     */
    public function create(User $user);
}