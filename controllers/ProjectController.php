<?php

namespace app\controllers;

use app\services\ProjectService;
use Yii;
use yii\base\Module;
use yii\helpers\Url;

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

    /**
     * @param int $id
     *
     * @return string
     */
    public function actionShow($id)
    {
        $users = $this->projectService->findUsers((int)$id);

        $year = date('Y');
        $month = date('m');
        $project = $this->projectService->findProjectWithTicks((int)$id, $year, $month);

        $tickMap = $this->projectService->createTickMap($project);

        return $this->render('show', [
            'users' => $users,
            'project' => $project,
            'year' => $year,
            'month' => $month,
            'tickMap' => $tickMap
        ]);
    }

    /**
     * Join current user to a project
     *
     * @param $id
     * @return \yii\web\Response
     */
    public function actionJoin($id)
    {
        $currentUser = Yii::$app->user->identity;

        if ($this->projectService->joinProject($currentUser->id, $id)) {
            Yii::$app->session->setFlash('success', 'Successfully joined project');

            return $this->redirect(Url::to(['project/show', 'id' => $id]));
        }

        Yii::$app->session->setFlash('error', 'Failed to join project');

        return $this->redirect(Url::to(['project/index']));
    }
}