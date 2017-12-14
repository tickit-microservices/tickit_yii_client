<?php

namespace app\controllers;

use app\services\UserService;
use Exception;
use Yii;
use yii\base\Module;
use yii\helpers\Url;

class SessionController extends BaseController
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * SessionController constructor.
     *
     * @param string $id
     * @param Module $module
     * @param UserService $userService
     * @param array $config
     */
    public function __construct(
        string $id,
        Module $module,
        UserService $userService,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);

        $this->userService = $userService;
    }

    /**
     * Display login form
     *
     * @return string
     */
    public function actionLoginForm()
    {
        return $this->render('login');
    }

    /**
     * Authenticate an user
     *
     * @return string
     */
    public function actionLogin()
    {
        $email = $this->request->post('email') ?? '';
        $password = $this->request->post('password') ?? '';

        $user = null;
        try {
            $user = $this->userService->authenticate($email, $password);

            Yii::$app->session->set('user', $user);

            return $this->redirect(Url::to(['project/index']));
        } catch (Exception $e) {
            return $this->render('login', [
                'errorMessage' => 'Login failed'
            ]);
        }
    }
}