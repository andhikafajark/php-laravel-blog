<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Nwidart\Modules\Facades\Module as ModuleFacade;
use Nwidart\Modules\Laravel\Module;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected Module $_module;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $moduleName = explode("\\", static ::class)[1];

        $this->_module = ModuleFacade::find($moduleName);

        view()->share([
            'module' => $this->_module
        ]);
    }
}
