<?php

namespace app\providers;

use app\entities\repositories\TickRepositoryInterface;
use app\services\TickService;
use app\services\UserService;
use Yii;
use yii\base\BootstrapInterface;

class TickServiceProvider implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Yii::$container->setSingleton(TickService::class, function () {
            /** @var TickRepositoryInterface $tickRepository */
            $tickRepository = Yii::$container->get(TickRepositoryInterface::class);

            /** @var UserService $userService */
            $userService = Yii::$container->get(UserService::class);

            return new TickService($tickRepository, $userService);
        });
    }
}
