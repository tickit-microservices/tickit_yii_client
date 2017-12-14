<?php

namespace app\providers;

use app\entities\repositories\ProjectRepositoryInterface;
use app\services\ProjectService;
use Yii;
use yii\base\BootstrapInterface;

class ProjectServiceProvider implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Yii::$container->setSingleton(ProjectService::class, function () {
            /** @var ProjectRepositoryInterface $projectRepository */
            $projectRepository = Yii::$container->get(ProjectRepositoryInterface::class);

            return new ProjectService($projectRepository);
        });
    }
}
