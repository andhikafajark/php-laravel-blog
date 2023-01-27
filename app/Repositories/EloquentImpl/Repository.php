<?php

namespace App\Repositories\EloquentImpl;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Repository
{
    public function __construct(protected Model $model)
    {
    }

    /**
     * Get all the resource from DB.
     *
     * @param $filterDomain
     * @return mixed
     */
    public function getAll($filterDomain = null)
    {
        return $this->model->get();
    }

    /**
     * Create a resource from DB.
     *
     * @param $domain
     * @return mixed
     */
    public function create($domain)
    {
        return $this->model->create($domain);
    }

    /**
     * Get specific resource from DB.
     *
     * @param $domain
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getOne($domain)
    {
        return $this->model->findOrFail($domain['id']);
    }

    /**
     * Update specific resource from DB.
     *
     * @param  $domain
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function update($domain)
    {
        $this->model
            ->findOrFail($domain['id'])
            ->update($domain);

        return $this->model->findOrFail($domain['id']);
    }

    /**
     * Delete specific resource from DB.
     *
     * @param $domain
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete($domain): bool
    {
        return $this->model
            ->findOrFail($domain['id'])
            ->delete();
    }

    /**
     * Get query from model.
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * Get all with pagination the resource from DB.
     *
     * @param $filterDomain
     * @return mixed
     */
    public function getAllWithPagination($filterDomain = null)
    {
        return $this->model->paginate($filterDomain['limit'] ?? 5);
    }
}
