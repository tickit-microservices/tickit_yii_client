<?php

namespace app\services;

use app\entities\models\Project;
use app\entities\repositories\ProjectRepositoryInterface;

class ProjectService
{
    /**
     * @var ProjectRepositoryInterface
     */
    protected $repository;

    /**
     * ProjectService constructor.
     *
     * @param ProjectRepositoryInterface $repository
     */
    public function __construct(ProjectRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return all projects
     *
     * @return Project[]
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * Return projects by user
     *
     * @param int $userId
     *
     * @return Project[]
     */
    public function findProjectsByUser(int $userId)
    {
        return $this->repository->findProjectsByUser($userId);
    }

    /**
     * Join an user to a project
     *
     * @param int $userId
     * @param int $projectId
     *
     * @return Project[]
     */
    public function joinProject($userId, $projectId)
    {
        return $this->repository->joinProject($userId, $projectId);
    }
}