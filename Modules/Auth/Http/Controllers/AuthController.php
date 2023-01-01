<?php

namespace Modules\Auth\Http\Controllers;

use App\Helpers\Log;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\LoginRequest;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct(
        private string $_route = 'auth.',
        private string $_routeView = '',
        private string $_title = 'Auth',
    )
    {
        parent::__construct();

        view()->share([
            'route' => $this->_route,
            'title' => $this->_title
        ]);
    }

    /**
     * Show login page.
     *
     * @return Factory|View|Application
     */
    public function showLogin(): Factory|View|Application
    {
        $data = [
            'route' => $this->_route . 'login',
            'title' => 'Login'
        ];

        return view($this->_module->getLowerName() . '::' . $this->_routeView . __FUNCTION__, $data);
    }

    /**
     * Authenticate user login.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            if (!auth()->attempt($request->validated())) {
                throw new BadRequestException('Username or password is wrong');
            }

            return response()->json([
                'success' => true,
                'message' => 'Login Success',
                'data' => [
                    'route' => route(RouteServiceProvider::HOME)
                ]
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::exception($e, __METHOD__);

            throw $e;
        }
    }

    /**
     * Logout user.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            session()->flush();
            auth()->logout();

            return response()->json([
                'success' => true,
                'message' => 'Logout Success',
                'data' => [
                    'route' => route($this->_route . 'login.show')
                ]
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::exception($e, __METHOD__);

            throw $e;
        }
    }
}
