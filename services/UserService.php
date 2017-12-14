<?php

namespace app\services;

use app\entities\models\User;
use app\entities\repositories\UserRepositoryInterface;
use Yii;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return User
     */
    public function authenticate(string $email, string $password)
    {
        $user = $this->userRepository->authenticate($email, $password);

        Yii::$app->user->login($user);

        return $user;
    }
}