<?php

namespace Modules\Blog\Services;

interface BlogCategoryService
{
    public function getAll($indexRequest);

    public function create($createRequest);

    public function getOne($showRequest);

    public function update($updateRequest);

    public function delete($deleteRequest): bool;

    public function getDatatable($datatableRequest, $options = []);
}
