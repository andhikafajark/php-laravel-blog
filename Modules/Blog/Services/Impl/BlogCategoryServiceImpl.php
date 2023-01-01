<?php

namespace Modules\Blog\Services\Impl;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Blog\Repositories\BlogCategoryRepository;
use Modules\Blog\Services\BlogCategoryService;
use Yajra\DataTables\DataTables;

class BlogCategoryServiceImpl implements BlogCategoryService
{
    public function __construct(private BlogCategoryRepository $blogCategoryRepository)
    {
    }

    /**
     * Get all the resource.
     *
     * @param $indexRequest
     * @return array
     */
    public function getAll($indexRequest): array
    {
        return $this->blogCategoryRepository->getAll($indexRequest);
    }

    /**
     * Create a resource.
     *
     * @param $createRequest
     */
    public function create($createRequest)
    {
        return $this->blogCategoryRepository->create($createRequest);
    }

    /**
     * Get specific resource.
     *
     * @param $showRequest
     * @throws ModelNotFoundException
     */
    public function getOne($showRequest)
    {
        return $this->blogCategoryRepository->getOne($showRequest);
    }


    /**
     * Update specific resource.
     *
     * @param $updateRequest
     * @throws ModelNotFoundException
     */
    public function update($updateRequest)
    {
        return $this->blogCategoryRepository->update($updateRequest);
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
        return $this->blogCategoryRepository->delete($deleteRequest);
    }

    /**
     * Get all the resource.
     *
     * @param $datatableRequest
     * @param array $options
     * @return JsonResponse
     * @throws Exception
     */
    public function getDatatable($datatableRequest, $options = [])
    {
        $query = $this->blogCategoryRepository->query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($data) use ($options) {
                return view($options['module']->getLowerName() . '::' . $options['routeView'] . 'components.action-datatables', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
