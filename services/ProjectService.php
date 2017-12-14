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
}