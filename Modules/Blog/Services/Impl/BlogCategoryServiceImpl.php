<?php

namespace Modules\Blog\Services\Impl;

use App\Services\EloquentImpl\Service;
use Exception;
use Illuminate\Http\JsonResponse;
use Modules\Blog\Repositories\BlogCategoryRepository;
use Modules\Blog\Services\BlogCategoryService;
use Yajra\DataTables\DataTables;

class BlogCategoryServiceImpl extends Service implements BlogCategoryService
{
    public function __construct(private BlogCategoryRepository $blogCategoryRepository)
    {
        parent::__construct($blogCategoryRepository);
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
