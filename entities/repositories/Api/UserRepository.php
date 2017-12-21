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

    /**
     * @inheritdoc
     */
    public function findByEmail(string $email)
    {
        $emailParams = http_build_query(['email' => $email]);
        $url = $this->getBaseUrl() . '/' . 'users?' . $emailParams;

        $response = $this->http->get($url);

        $data = json_decode($response->getBody());

        if ($data->data & count($data->data) === 1) {
            return new User((array) $data->data[0]);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function create(User $user)
    {
        $url = $this->getBaseUrl() . '/' . 'users';

        $response = $this->http->post($url, [
            'form_params' => [
                'first_name' => $user->firstName,
                'last_name' => $user->lastName,
                'email' => $user->email,
                'password' => $user->password
            ]
        ]);

        $data = json_decode($response->getBody())->data;

        return new User((array) $data);
    }

    private function getBaseUrl()
    {
        return getenv('USER_SERVICE_URL');
    }
}