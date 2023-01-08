<?php

namespace App\Services\EloquentImpl;

use App\Repositories\UserRepository;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class UserServiceImpl extends Service implements UserService
{
    public function __construct(private UserRepository $userRepository)
    {
        parent::__construct($this->userRepository);
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
        $query = $this->userRepository->query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->toJson();
    }
}
