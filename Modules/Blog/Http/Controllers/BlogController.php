<?php

namespace Modules\Blog\Http\Controllers;

use App\Helpers\Log;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Http\Requests\Blog\CreateRequest;
use Modules\Blog\Http\Requests\Blog\UpdateRequest;
use Modules\Blog\Models\Blog;
use Modules\Blog\Services\BlogCategoryService;
use Modules\Blog\Services\BlogService;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private BlogService $blogService,
        private BlogCategoryService $blogCategoryService,
        private string      $_route = 'blog.',
        private string      $_routeView = 'blog.',
        private string      $_title = 'Blog',
    )
    {
        parent::__construct();

        view()->share([
            'route' => $this->_route,
            'title' => $this->_title
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View|Factory|JsonResponse|Application
    {
        if ($request->ajax()) {
            $data = $request->all();
            $options = [
                'module' => $this->_module,
                'routeView' => $this->_routeView,
            ];

            return $this->blogService->getDatatable($data, $options);
        }
        $data = [
            'title' => $this->_title,
            'breadcrumbs' => [
                'Dashboard' => RouteServiceProvider::HOME,
                'Blog' => null
            ]
        ];

        return view($this->_module->getLowerName() . '::' . $this->_routeView . __FUNCTION__, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $data = [
            'title' => 'Create ' . $this->_title,
            'breadcrumbs' => [
                'Dashboard' => RouteServiceProvider::HOME,
                'Blog' => $this->_route . 'index',
                'Create' => null
            ],
            'blogCategories' => $this->blogCategoryService->getAll()
        ];

        return view($this->_module->getLowerName() . '::' . $this->_routeView . __FUNCTION__, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(CreateRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            $this->blogService->create($data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Create Success',
                'data' => null
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollBack();

            Log::exception($e, __METHOD__);

            throw $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Blog $blog
     * @return Application|Factory|View
     */
    public function edit(Blog $blog): View|Factory|Application
    {
        $data = [
            'title' => 'Edit ' . $this->_title,
            'breadcrumbs' => [
                'Dashboard' => RouteServiceProvider::HOME,
                'Blog Category' => $this->_route . 'index',
                'Edit' => null
            ],
            'blog' => $blog->with(['headlineImage'])->findOrFail($blog->id),
            'blogCategories' => $this->blogCategoryService->getAll()
        ];

        return view($this->_module->getLowerName() . '::' . $this->_routeView . __FUNCTION__, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Blog $blog
     * @return JsonResponse
     * @throws Exception
     */
    public function update(UpdateRequest $request, Blog $blog): JsonResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $data['id'] = $blog->id;

            $this->blogService->update($data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Update Data Success',
                'data' => null
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();

            Log::exception($e, __METHOD__);

            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Blog $blog
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Request $request, Blog $blog): JsonResponse
    {
        try {
            DB::beginTransaction();

            $data = [
                'id' => $blog->id
            ];

            $this->blogService->delete($data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Delete Data Success',
                'data' => null
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();

            Log::exception($e, __METHOD__);

            throw $e;
        }
    }
}
