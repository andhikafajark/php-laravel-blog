<?php

namespace App\Repositories;

interface FileRepository
{
    public function getAll($filterDomain = null);

    public function create($fileDomain);

    public function getOne($fileDomain);

    public function update($fileDomain);

    public function delete($fileDomain): bool;

    public function query();

    public function updateOrCreate($fileDomain);
}
