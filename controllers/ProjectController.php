<?php

namespace app\controllers;

use app\entities\models\User;
use app\services\ProjectService;
use Yii;
use yii\base\Module;
use yii\helpers\Url;
use yii\web\Response;

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
        $currentUser = Yii::$app->user->identity;
        $users = $this->projectService->findUsers((int)$id);

        $year = (int)(Yii::$app->request->get('y') ?? date('Y'));
        $month = (int)(Yii::$app->request->get('m') ?? date('m'));
        $lastDay = date('t', strtotime("$year-$month-1"));

        $previousYear = $month === 1 ? $year - 1 : $year;
        $previousMonth = $month === 1 ? 12 : $month - 1;

        $nextYear = $month === 12 ? $year + 1 : $year;
        $nextMonth = $month === 12 ? 1 : $month + 1;

        $project = $this->projectService->findProjectWithTicks((int)$id, $year, $month);

        $tickMap = $this->projectService->createTickMap($project);

        return $this->render('show', [
            'currentUser' => $currentUser,
            'users' => $users,
            'project' => $project,
            'year' => $year,
            'month' => $month,
            'lastDay' => $lastDay,
            'tickMap' => $tickMap,
            'previousYear' => $previousYear,
            'previousMonth' => $previousMonth,
            'nextYear' => $nextYear,
            'nextMonth' => $nextMonth
        ]);
    }

    /**
     * Join current user to a project
     *
     * @param $id
     *
     * @return Response
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

    public function actionTick($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $currentUser = Yii::$app->user->identity;
        $date = Yii::$app->request->post('date');

        return $this->projectService->tick($id, $currentUser->getId(), $date);
    }

    public function actionRemoveTick($id, $tickId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        /** @var User $currentUser */
        $currentUser = Yii::$app->user->identity;

        return $this->projectService->unTick($id, $tickId, $currentUser);
    }
}