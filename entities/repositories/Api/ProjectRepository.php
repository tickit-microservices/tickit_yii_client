<?php

namespace app\entities\repositories\Api;

use app\entities\models\Project;
use app\entities\models\Tick;
use app\entities\models\User;
use app\entities\repositories\ProjectRepositoryInterface;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function findAll()
    {
        $url = $this->getProjectBaseUrl() . '/' . 'projects';

        $response = $this->http->get($url);

        $data = json_decode($response->getBody())->data;

        return collect($data)->map(function ($projectData) {
            return new Project($projectData);
        })->all();
    }

    /**
     * @inheritdoc
     */
    public function findProjectsByUser(int $userId)
    {
        $url = $this->getProjectBaseUrl() . '/' . 'users' . '/' . $userId . '/' . 'projects';

        $response = $this->http->get($url);

        $data = json_decode($response->getBody())->data;

        return collect($data)->map(function ($projectData) {
            return new Project($projectData);
        })->all();
    }

    /**
     * @inheritdoc
     */
    public function findUsers(int $projectId)
    {
        $url = $this->getProjectBaseUrl() . '/' . 'projects' . '/' . $projectId . '/users';

        $response = $this->http->get($url);

        $data = json_decode($response->getBody())->data;

        return collect($data)->map(function ($userData) {
            return new User($userData);
        })->all();
    }

    /**
     * @inheritdoc
     */
    public function findProjectWithTicks(int $projectId, int $year, int $month)
    {
        $url = $this->getProjectBaseUrl() . '/' . 'projects' . '/' . $projectId . '/ticks/' . $year . '/' . $month;

        $response = $this->http->get($url);

        $projectData = json_decode($response->getBody())->data;

        //TODO create ProjectFactory & TickFactory
        $ticks = collect($projectData->ticks)->map(function ($tickData) {
            return new Tick($tickData);
        })->all();
        $project = new Project($projectData);
        $project->ticks = $ticks;

        return $project;
    }

    /**
     * @inheritdoc
     */
    public function joinProject(int $userId, int $projectId)
    {
        $url = $this->getProjectBaseUrl() . '/' . 'users' . '/' . $userId . '/' . 'join' . '/' . $projectId;

        $response = $this->http->post($url);

        $data = json_decode($response->getBody())->data;

        return collect($data)->map(function ($projectData) {
            return new Project($projectData);
        });
    }

    private function getProjectBaseUrl()
    {
        return getenv('PROJECT_SERVICE_URL');
    }
}