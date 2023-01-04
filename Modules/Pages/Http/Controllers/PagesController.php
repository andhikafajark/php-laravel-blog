<?php

namespace Modules\Pages\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Modules\Blog\Models\Blog;
use Modules\Blog\Services\BlogCategoryService;
use Modules\Blog\Services\BlogService;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private BlogService $blogService,
        private BlogCategoryService $blogCategoryService,
        private string      $_route = 'pages.',
        private string      $_routeView = '',
        private string      $_title = '',
    )
    {
        parent::__construct();

        view()->share([
            'route' => $this->_route,
            'title' => $this->_title,
            'blogs' => $this->blogService->getAll(),
            'blogCategories' => $this->blogCategoryService->getAll()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $data = [
            'title' => 'Home'
        ];

        return view($this->_module->getLowerName() . '::' . $this->_routeView . __FUNCTION__, $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Blog $blog
     * @return Application|Factory|View
     */
    public function blog(Request $request, Blog $blog): View|Factory|Application
    {
        $blog = $blog->with(['creator', 'blogCategory'])->findOrFail($blog->id);

        $data = [
            'title' => 'Blog',
            'blog' => $blog
        ];

        return view($this->_module->getLowerName() . '::' . $this->_routeView . __FUNCTION__, $data);
    }
}
