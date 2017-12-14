<?php

namespace app\entities\repositories\Api;

use app\entities\models\Project;
use app\entities\repositories\ProjectRepositoryInterface;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function findProjectsByUser(int $userId)
    {
        $url = $this->getBaseUrl() . '/' . 'users' . '/' . $userId . '/' . 'projects';

        $response = $this->http->get($url);

        $data = json_decode($response->getBody())->data;

        return collect($data)->map(function ($projectData) {
            return new Project($projectData);
        })->all();
    }

    private function getBaseUrl()
    {
        return getenv('PROJECT_SERVICE_URL');
    }
}