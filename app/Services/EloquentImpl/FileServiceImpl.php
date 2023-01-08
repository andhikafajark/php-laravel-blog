<?php

namespace App\Services\EloquentImpl;

use App\Helpers\File;
use App\Repositories\FileRepository;
use App\Services\FileService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FileServiceImpl implements FileService
{
    public function __construct(private FileRepository $fileRepository)
    {
    }

    /**
     * Create or update a resource.
     *
     * @param $saveRequest
     * @return mixed
     */
    public function save($saveRequest)
    {
        if ($id = $saveRequest['id'] ?? null) {
            $file = $this->fileRepository->getOne((['id' => $id]));

            File::delete($file->path . $file->hash_name);
        }

        $saveRequest['file']->store($saveRequest['path']);

        $filter = [
            'id' => $id
        ];
        $data = [
            'original_name' => $saveRequest['file']->getClientOriginalName(),
            'hash_name' => $saveRequest['file']->hashName(),
            'path' => $saveRequest['path'],
            'extension' => $saveRequest['file']->getClientOriginalExtension(),
            'mime_type' => $saveRequest['file']->getClientMimeType(),
            'size' => $saveRequest['file']->getSize(),
        ];

        return $this->fileRepository->updateOrCreate([
            'filter' => $filter,
            'data' => $data
        ]);
    }

    /**
     * Get specific resource.
     *
     * @param $showRequest
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getOne($showRequest)
    {
        return $this->fileRepository->getOne($showRequest);
    }

    /**
     * Delete specific resource.
     *
     * @param $deleteRequest
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete($deleteRequest): bool
    {
        $id = $deleteRequest['id'] ?? null;

        if (!$id) return false;

        $file = $this->fileRepository->getOne((['id' => $id]));

        File::delete($file->path . $file->hash_name);

        return $this->fileRepository->delete($deleteRequest);
    }
}
