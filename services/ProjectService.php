<?php

namespace app\services;

use app\entities\models\Project;
use app\entities\models\User;
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
     * Find all users in a project
     *
     * @param int $projectId
     *
     * @return User[]
     */
    public function findUsers(int $projectId)
    {
        return $this->repository->findUsers($projectId);
    }

    /**
     * Find a project by id and populate all ticks within a month
     *
     * @param int $projectId
     * @param int $year
     * @param int $month
     *
     * @return Project|null
     */
    public function findProjectWithTicks(int $projectId, int $year, int $month)
    {
        return $this->repository->findProjectWithTicks($projectId, $year, $month);
    }

    public function tick(int $projectId, int $userId, string $date)
    {
        return $this->repository->tick($projectId, $userId, $date);
    }

    public function unTick(int $projectId, int $tickId, User $user)
    {
        return $this->repository->unTick($projectId, $tickId, $user);
    }

    public function createTickMap(Project $project)
    {
        $tickMap = [];

        foreach ($project->ticks as $tick)
        {
            $createdDate = date('Y-m-d', strtotime($tick->created));
            $tickMap[$createdDate][$tick->user->id] = $tick;
        }

        return $tickMap;
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