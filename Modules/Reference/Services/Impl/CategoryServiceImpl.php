<?php

namespace Modules\Reference\Services\Impl;

use App\Services\EloquentImpl\Service;
use Exception;
use Illuminate\Http\JsonResponse;
use Modules\Reference\Repositories\CategoryRepository;
use Modules\Reference\Services\CategoryService;
use Yajra\DataTables\DataTables;

class CategoryServiceImpl extends Service implements CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
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
        $query = $this->categoryRepository->query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('type', function ($data) use ($options) {
                return str($data->type ?? '')->snake()->replace('_', ' ')->title();
            })
            ->addColumn('action', function ($data) use ($options) {
                return view($options['module']->getLowerName() . '::' . $options['routeView'] . 'components.action-datatables', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
