<?php

namespace app\entities\repositories\Api;

use app\entities\models\Project;
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