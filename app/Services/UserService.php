<?php

namespace App\Services;

interface UserService
{
    public function getAll($indexRequest = null);

    public function create($createRequest);

    public function getOne($showRequest);

    public function update($updateRequest);

    public function delete($deleteRequest): bool;

    public function getDatatable($datatableRequest, $options = []);
}
