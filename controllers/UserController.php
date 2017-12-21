<?php

namespace app\controllers;

use app\services\UserService;
use Yii;
use yii\base\Module;
use yii\helpers\Url;

class UserController extends BaseController
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
     * Render sign up form
     *
     * @return string
     */
    public function actionSignUpForm()
    {
        return $this->render('sign-up');
    }

    /**
     * Sign up user account
     *
     * @return string
     */
    public function actionSignUp()
    {
        $userData = $this->request->post();

        $signUpResult = $this->userService->signUp($userData);

        if ($signUpResult->success) {
            Yii::$app->session->setFlash('success', $signUpResult->message);

            return $this->redirect(Url::to(['session/login-form']));
        }

        return $this->render('sign-up', [
            'errorMessage' => $signUpResult->message,
            'userData' => $userData
        ]);
    }
}