<?php

namespace Modules\Blog\Repositories;

interface BlogRepository
{
    public function getAll($filterDomain = null);

    public function create($blogDomain);

    public function getOne($blogDomain);

    public function update($blogDomain);

    public function delete($blogDomain): bool;

    public function query();

    public function getAllWithPagination($filterDomain = null);
}
