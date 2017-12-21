<?php

namespace app\services;

use app\entities\models\User;
use app\entities\repositories\UserRepositoryInterface;
use app\entities\ValueObjects\SignUpResult;
use Yii;
use yii\validators\EmailValidator;

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

    /**
     * @param array $userData
     *
     * @return SignUpResult
     */
    public function signUp($userData = [])
    {
        $message = '';

        if ($this->validateSignUpData($userData, $message)) {
            $user = new User([
                'firstName' => $userData['first-name'],
                'lastName' => $userData['last-name'],
                'email' => $userData['email'],
                'password' => $userData['password']
            ]);

            if ($this->userRepository->create($user)) {
                return new SignUpResult([
                    'success' => true,
                    'message' => 'Your account has been signed up!'
                ]);
            }
        }

        return new SignUpResult([
            'success' => false,
            'message' => $message
        ]);

    }

    /**
     * Validate email, password & password confirmation
     *
     * @param array $userData
     * @param string $message
     *
     * @return bool
     */
    private function validateSignUpData(array $userData = [], ?string &$message = '')
    {
        $message = '';

        $firstName = $userData['first-name'] ?? '';
        $lastName = $userData['last-name'] ?? '';
        $email = $userData['email'] ?? '';
        $password = $userData['password'] ?? '';
        $passwordConfirmation = $userData['password-confirmation'] ?? '';

        if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($passwordConfirmation)) {
            $message = 'All fields are required!';
            return false;
        }

        $validator = new EmailValidator();
        if (!$validator->validate($email)) {
            $message = 'Email is invalid!';
            return false;
        }

        if ($password !== $passwordConfirmation) {
            $message = 'Password confirmation is not correct!';
            return false;
        }

        $user = $this->userRepository->findByEmail($email);
        if ($user) {
            $message = 'Email is taken already!';
            return false;
        }

        return true;
    }
}