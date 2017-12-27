<?php

namespace app\entities\repositories;

use app\entities\models\Project;
use app\entities\models\User;

interface ProjectRepositoryInterface
{
    /**
     * Find all users in project
     *
     * @param int $projectId
     *
     * @return User[]
     */
    public function findUsers(int $projectId);

    /**
     * Return all projects
     *
     * @return Project[]
     */
    public function findAll();

    /**
     * Find a project with ticks of a month
     *
     * @param int $projectId
     * @param int $year
     * @param int $month
     *
     * @return Project|null
     */
    public function findProjectWithTicks(int $projectId, int $year, int $month);

    /**
     * Return projects of an user
     *
     * @param int $userId
     *
     * @return Project[]
     */
    public function findProjectsByUser(int $userId);

    /**
     * Join an user to a project
     *
     * @param int $userId
     * @param int $projectId
     *
     * @return Project[] List of joined projects
     */
    public function joinProject(int $userId, int $projectId);
}