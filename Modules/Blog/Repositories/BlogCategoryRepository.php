<?php

namespace Modules\Blog\Repositories;

interface BlogCategoryRepository
{
    public function getAll($filterDomain = null);

    public function create($blogCategoryDomain);

    public function getOne($blogCategoryDomain);

    public function update($blogCategoryDomain);

    public function delete($blogCategoryDomain): bool;

    public function query();
}
