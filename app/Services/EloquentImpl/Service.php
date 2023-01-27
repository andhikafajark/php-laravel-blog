<?php

namespace App\Services\EloquentImpl;

use App\Repositories\EloquentImpl\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Service
{
    public function __construct(protected Repository $repository)
    {
    }

    /**
     * Get all the resource.
     *
     * @param $indexRequest
     * @return mixed
     */
    public function getAll($indexRequest = null)
    {
        return $this->repository->getAll($indexRequest);
    }

    /**
     * Create a resource.
     *
     * @param $createRequest
     * @return mixed
     */
    public function create($createRequest)
    {
        return $this->repository->create($createRequest);
    }

    /**
     * Get specific resource.
     *
     * @param $showRequest
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getOne($showRequest)
    {
        return $this->repository->getOne($showRequest);
    }


    /**
     * Update specific resource.
     *
     * @param $updateRequest
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function update($updateRequest)
    {
        return $this->repository->update($updateRequest);
    }

    /**
     * Delete specific resource.
     *
     * @param $deleteRequest
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete($deleteRequest): bool
    {
        return $this->repository->delete($deleteRequest);
    }

    /**
     * Get all the resource.
     *
     * @param $indexRequest
     * @return mixed
     */
    public function getAllWithPagination($indexRequest = null)
    {
        return $this->repository->getAllWithPagination($indexRequest);
    }
}
