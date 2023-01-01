<?php

namespace Modules\Blog\Repositories;

interface BlogRepository
{
    public function getAll($filterDomain);

    public function create($blogDomain);

    public function getOne($blogDomain);

    public function update($blogDomain);

    public function delete($blogDomain): bool;

    public function query();
}
