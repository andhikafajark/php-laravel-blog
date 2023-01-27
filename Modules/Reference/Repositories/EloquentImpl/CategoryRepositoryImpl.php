<?php

namespace Modules\Reference\Repositories\EloquentImpl;

use App\Repositories\EloquentImpl\Repository;
use Modules\Reference\Models\Category;
use Modules\Reference\Repositories\CategoryRepository;

class CategoryRepositoryImpl extends Repository implements CategoryRepository
{
    public function __construct(private Category $category)
    {
        parent::__construct($category);
    }
}
