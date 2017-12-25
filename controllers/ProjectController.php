<?php

namespace app\controllers;

use app\services\ProjectService;
use Yii;
use yii\base\Module;

class ProjectController extends BaseController
{
    /**
     * @var ProjectService
     */
    private $projectService;

    /**
     * ProjectController constructor.
     *
     * @param string $id
     * @param Module $module
     * @param ProjectService $projectService
     * @param array $config
     */
    public function __construct(
        string $id,
        Module $module,
        ProjectService $projectService,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);

        $this->projectService = $projectService;
    }

    /**
     * List all projects of current user
     *
     * @return string
     */
    public function actionIndex()
    {
        $currentUser = Yii::$app->user->identity;

        $allProjects = $this->projectService->findAll();

        $userProjects = $this->projectService->findProjectsByUser($currentUser->id);

        $projectUserMap = [];
        foreach ($userProjects as $userProject)
        {
            $projectUserMap[$userProject->id] = true;
        }

        return $this->render('index', [
            'allProjects' => $allProjects,
            'projectUserMap' => $projectUserMap
        ]);
    }

    public function actionShow($id)
    {
    }

    public function actionJoin($id)
    {
    }
}