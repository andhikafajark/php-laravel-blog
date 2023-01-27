<?php

namespace Modules\Blog\Services;

interface BlogService
{
    public function getAll($indexRequest = null);

    public function create($createRequest);

    public function getOne($showRequest);

    public function update($updateRequest);

    public function delete($deleteRequest): bool;

    public function getAllWithPagination($indexRequest = null);

    public function getDatatable($datatableRequest, $options = []);
}
