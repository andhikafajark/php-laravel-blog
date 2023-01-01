<?php

namespace Modules\Blog\Repositories\EloquentImpl;

use App\Repositories\Impl\Repository;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Repositories\BlogCategoryRepository;

class BlogCategoryRepositoryImpl extends Repository implements BlogCategoryRepository
{
    public function __construct(private BlogCategory $blogCategory)
    {
        parent::__construct($blogCategory);
    }
}
