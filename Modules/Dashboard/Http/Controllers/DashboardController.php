<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Nwidart\Modules\Facades\Module as ModuleFacade;
use Nwidart\Modules\Laravel\Module;

class DashboardController extends Controller
{
    private Module $_module;

    /**
     * Create a new controller instance.
     */
    public function __construct(
        private string $_route = 'dashboard.',
        private string $_routeView = '',
        private string $_title = 'Dashboard',
    )
    {
        $moduleName = explode("\\", static ::class)[1];

        $this->_module = ModuleFacade::find($moduleName);

        view()->share([
            'module' => $this->_module,
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
            ]
        ];

        return view($this->_module->getLowerName() . '::' . $this->_routeView . __FUNCTION__, $data);
    }
}
