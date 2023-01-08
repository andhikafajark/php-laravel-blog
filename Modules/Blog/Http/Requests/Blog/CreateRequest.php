<?php

namespace Modules\Blog\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'blog_category_id' => 'bail|required|string|exists:blog_categories,id',
            'title' => 'bail|required|string|max:255|unique:blogs',
            'content' => 'bail|required|string',
            'headline_image' => 'bail|required|image',
            'is_active' => 'bail|required|boolean'
        ];
    }
}
