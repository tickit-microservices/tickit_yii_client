<?php

namespace app\entities\repositories\Api;

use app\entities\models\User;
use app\entities\repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function authenticate(string $email, string $password)
    {
        $url = $this->getBaseUrl() . '/' . 'sessions';

        $response = $this->http->post($url, [
            'form_params' => [
                'email' => $email,
                'password' => $password
            ]
        ]);

        $data = json_decode($response->getBody())->data;

        $user = new User($data->user);
        $user->token = $data->token;
        $user->expired = $data->expired;

        return $user;
    }

    private function getBaseUrl()
    {
        return getenv('USER_SERVICE_URL');
    }
}