<?php

namespace App\Repositories\EloquentImpl;

use App\Models\File;
use App\Repositories\FileRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FileRepositoryImpl extends Repository implements FileRepository
{
    public function __construct(private File $file)
    {
        parent::__construct($file);
    }

    /**
     * Update specific resource from DB.
     *
     * @param  $domain
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateOrCreate($domain)
    {
        return $this->model->updateOrCreate(
            $domain['filter'],
            $domain['data'],
        );
    }
}
