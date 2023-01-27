<?php

namespace Modules\Reference\Http\Requests\Category;

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
            'title' => 'bail|required|string|max:255|unique:categories,title,NULL,id,deleted_at,NULL',
            'type' => 'bail|required|string|max:255'
        ];
    }
}
