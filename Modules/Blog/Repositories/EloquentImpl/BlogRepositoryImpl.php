<?php

namespace Modules\Blog\Repositories\EloquentImpl;

use App\Repositories\EloquentImpl\Repository;
use Modules\Blog\Models\Blog;
use Modules\Blog\Repositories\BlogRepository;

class BlogRepositoryImpl extends Repository implements BlogRepository
{
    public function __construct(private Blog $blog)
    {
        parent::__construct($blog);
    }

    /**
     * Get all the resource from DB.
     *
     * @param $filterDomain
     * @return mixed
     */
    public function getAll($filterDomain = null)
    {
        return $this->model
            ->when(!empty($filterDomain['category']), function ($query) use ($filterDomain) {
                $query->whereHas('categories', function ($query) use ($filterDomain) {
                    $query->where('slug', $filterDomain['category']);
                });
            })->get();
    }

    /**
     * Get all with pagination the resource from DB.
     *
     * @param $filterDomain
     * @return mixed
     */
    public function getAllWithPagination($filterDomain = null)
    {
        return $this->model
            ->when(!empty($filterDomain['category']), function ($query) use ($filterDomain) {
                $query->whereHas('categories', function ($query) use ($filterDomain) {
                    $query->where('slug', $filterDomain['category']);
                });
            })
            ->latest('created_at')
            ->paginate($filterDomain['limit'] ?? 5);
    }
}
