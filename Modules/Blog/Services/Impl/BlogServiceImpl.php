<?php

namespace Modules\Blog\Services\Impl;

use App\Services\EloquentImpl\Service;
use Exception;
use Illuminate\Http\JsonResponse;
use Modules\Blog\Repositories\BlogRepository;
use Modules\Blog\Services\BlogService;
use Yajra\DataTables\DataTables;

class BlogServiceImpl extends Service implements BlogService
{
    public function __construct(private BlogRepository $blogRepository)
    {
        parent::__construct($this->blogRepository);
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
