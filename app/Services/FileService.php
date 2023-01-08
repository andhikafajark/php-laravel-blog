<?php

namespace App\Services;

interface FileService
{
    public function getOne($showRequest);

    public function delete($deleteRequest): bool;

    public function save($saveRequest);
}
