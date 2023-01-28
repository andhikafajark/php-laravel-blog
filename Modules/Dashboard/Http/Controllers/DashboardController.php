<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Modules\Blog\Models\Blog;
use Modules\Blog\Models\BlogCategory;
use Modules\Reference\Models\Category;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private string $_route = 'dashboard.',
        private string $_routeView = '',
        private string $_title = 'Dashboard',
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
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $data = [
            'breadcrumbs' => (object)[
                'Dashboard' => null
            ],
            'countBlogCategory' => Category::where('type', 'blog')->count(),
            'countBlog' => Blog::count(),
        ];

        return view($this->_module->getLowerName() . '::' . $this->_routeView . __FUNCTION__, $data);
    }
}
