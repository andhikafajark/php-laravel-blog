<?php

namespace Modules\Blog\Services\Impl;

use App\Helpers\File;
use App\Services\EloquentImpl\Service;
use App\Services\FileService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Blog\Repositories\BlogRepository;
use Modules\Blog\Services\BlogService;
use Yajra\DataTables\DataTables;

class BlogServiceImpl extends Service implements BlogService
{
    public function __construct(
        private BlogRepository $blogRepository,
        private FileService    $fileService,
        private string         $_pathFileHeadlineImage = 'public/files/blogs/headlines/',
    )
    {
        parent::__construct($this->blogRepository);
    }

    /**
     * Create a resource.
     *
     * @param $createRequest
     * @return mixed
     * @throws Exception
     */
    public function create($createRequest)
    {
        try {
            $file = $this->fileService->save([
                'file' => $createRequest['headline_image'],
                'path' => $this->_pathFileHeadlineImage
            ]);

            unset($createRequest['headline_image']);

            $createRequest['headline_image_id'] = $file->id;

            return $this->blogRepository->create($createRequest);
        } catch (Exception $e) {
            File::delete($file->path . $file->hash_name);

            throw $e;
        }
    }

    /**
     * Update specific resource.
     *
     * @param $updateRequest
     * @return mixed
     * @throws Exception
     */
    public function update($updateRequest)
    {
        try {
            if (!empty($updateRequest['headline_image'])) {
                $blog = $this->blogRepository->getOne(['id' => $updateRequest['id']]);

                $file = $this->fileService->save([
                    'id' => $blog->headline_image_id,
                    'file' => $updateRequest['headline_image'],
                    'path' => $this->_pathFileHeadlineImage
                ]);

                unset($updateRequest['headline_image']);

                $updateRequest['headline_image_id'] = $file->id;
            }

            return $this->blogRepository->update($updateRequest);
        } catch (Exception $e) {
            if (!empty($updateRequest['headline_image'])) File::delete($file->path . $file->hash_name);

            throw $e;
        }
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
        $blog = $this->blogRepository->getOne(['id' => $deleteRequest['id']]);

        $this->blogRepository->delete(['id' => $deleteRequest['id']]);

        return $this->fileService->delete(['id' => $blog->headline_image_id]);
    }

    /**
     * Get all the resource.
     *
     * @param $datatableRequest
     * @param array $options
     * @return JsonResponse
     * @throws Exception
     */
    public function getDatatable($datatableRequest, $options = [])
    {
        $query = $this->blogRepository->query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('headline_image', function ($data) use ($options) {
                return view($options['module']->getLowerName() . '::' . $options['routeView'] . 'components.headline-image-datatables', compact('data'));
            })
            ->editColumn('is_active', function ($data) use ($options) {
                return view($options['module']->getLowerName() . '::' . $options['routeView'] . 'components.is-active-datatables', compact('data'));
            })
            ->addColumn('action', function ($data) use ($options) {
                return view($options['module']->getLowerName() . '::' . $options['routeView'] . 'components.action-datatables', compact('data'));
            })
            ->rawColumns(['is_active', 'action'])
            ->toJson();
    }
}
