<?php

namespace app\entities\repositories;

use app\entities\models\Project;

interface ProjectRepositoryInterface
{
    /**
     * Return all projects
     *
     * @return Project[]
     */
    public function findAll();

    /**
     * Return projects of an user
     *
     * @param int $userId
     *
     * @return Project[]
     */
    public function findProjectsByUser(int $userId);
}