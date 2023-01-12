<?php

namespace Modules\Blog\Models;

use App\Traits\ByUser;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes, Uuid, ByUser;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Set title attribute and generate slug attribute
     * @param $value
     * @return void
     */
    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str($value)->slug();
    }
}
