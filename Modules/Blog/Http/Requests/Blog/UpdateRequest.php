<?php

namespace Modules\Blog\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $blog = $this->route('blog');

        return [
            'categories' => 'required|array|min:1',
            'categories.*' => 'required|string|distinct|exists:categories,id,deleted_at,NULL',
            'title' => $this->input('title') !== $blog->title ? 'bail|required|string|max:255|unique:blogs,title,NULL,id,deleted_at,NULL' : '',
            'content' => 'bail|required|string',
            'headline_image' => 'bail|nullable|image',
            'is_active' => 'bail|required|boolean'
        ];
    }
}
