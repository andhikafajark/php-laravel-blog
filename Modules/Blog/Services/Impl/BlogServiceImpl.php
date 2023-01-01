<?php

namespace Modules\Blog\Services\Impl;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Blog\Repositories\BlogRepository;
use Modules\Blog\Services\BlogService;
use Yajra\DataTables\DataTables;

class BlogServiceImpl implements BlogService
{
    public function __construct(private BlogRepository $blogRepository)
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
        return $this->blogRepository->getAll($indexRequest);
    }

    /**
     * Create a resource.
     *
     * @param $createRequest
     */
    public function create($createRequest)
    {
        return $this->blogRepository->create($createRequest);
    }

    /**
     * Get specific resource.
     *
     * @param $showRequest
     * @throws ModelNotFoundException
     */
    public function getOne($showRequest)
    {
        return $this->blogRepository->getOne($showRequest);
    }


    /**
     * Update specific resource.
     *
     * @param $updateRequest
     * @throws ModelNotFoundException
     */
    public function update($updateRequest)
    {
        return $this->blogRepository->update($updateRequest);
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
        return $this->blogRepository->delete($deleteRequest);
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
        $query = $this->blogRepository->query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('is_active', function ($data) use ($options) {
                return view($options['module']->getLowerName() . '::' . $options['routeView']. 'components.is-active-datatables', compact('data'));
            })
            ->addColumn('action', function ($data) use ($options) {
                return view($options['module']->getLowerName() . '::' . $options['routeView'] . 'components.action-datatables', compact('data'));
            })
            ->rawColumns(['is_active', 'action'])
            ->toJson();
    }
}
