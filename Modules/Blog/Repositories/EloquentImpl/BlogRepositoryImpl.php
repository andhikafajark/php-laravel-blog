<?php

namespace Modules\Blog\Repositories\EloquentImpl;

use App\Repositories\EloquentImpl\Repository;
use Modules\Blog\Models\Blog;
use Modules\Blog\Repositories\BlogRepository;

class BlogRepositoryImpl extends Repository implements BlogRepository
{
    public function __construct(private Blog $blog)
    {
        parent::__construct($blog);
    }
}
