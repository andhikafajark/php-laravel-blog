@extends('components.tailwindcss.templates.admin')

@section('content')

    <h1 class="text-3xl font-bold text-gray-900 my-4">{{ $title }}</h1>
    <div class="w-full px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50">
        <form id="form" action="{{ route($route . 'update', $blog) }}" method="post">

            @method('put')

            <div class="mb-4">
                <label for="blog_category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Blog
                    Category</label>
                <select id="blog_category_id" name="blog_category_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option disabled selected>Choose</option>

                    @forelse($blogCategories as $blogCategory)

                        <option
                            value="{{ $blogCategory->id }}" {{ $blog->blog_category_id === $blogCategory->id ? 'selected' : '' }}>{{ $blogCategory->title }}</option>

                    @empty @endforelse

                </select>
                <label id="blog_category_id-error" class="error text-xs text-red-500" for="blog_category_id"></label>
            </div>
            <div class="mb-4">
                <label for="title"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Title</label>
                <input type="text" id="title" name="title" value="{{ $blog->title ?? '' }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Title">
                <label id="title-error" class="error text-xs text-red-500" for="title"></label>
            </div>
            <div class="mb-4">
                <label for="content"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Content</label>
                <textarea id="content" rows="4" name="content"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="Content ...">{{ $blog->content ?? '' }}</textarea>
                <label id="content-error" class="error text-xs text-red-500" for="content"></label>
            </div>
            <div class="mb-4">
                <label for="headline_image"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Headline Image</label>
                <input type="file" id="headline_image" name="headline_image"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Headline Image">
                <label id="headline_image-error" class="error text-xs text-red-500" for="headline_image"></label>
                <img
                    src="{{ $blog->headlineImage && Storage::exists($blog->headlineImage->path . $blog->headlineImage->hash_name) ? asset(Storage::url($blog->headlineImage->path . $blog->headlineImage->hash_name)) : '' }}"
                    class="max-h-[200px] block rounded-lg mx-auto {{ $blog->headlineImage && Storage::exists($blog->headlineImage->path . $blog->headlineImage->hash_name) ? 'border mt-3' : 'hidden' }}"
                    data-type="image-preview"/>
            </div>
            <div class="flex items-start mb-4">
                <div class="flex items-center h-5">
                    <input id="is_active" type="checkbox" name="is_active" {{ $blog->is_active ? 'checked' : '' }}
                    class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                </div>
                <label for="is_active" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-400">Active</label>
                <label id="is_active-error" class="error text-xs text-red-500" for="is_active"></label>
            </div>
            <div class="flex justify-end gap-1">
                <a href="{{ route($route . 'index') }}"
                   class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Back
                </a>
                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Submit
                </button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            handler()
        })

        function handler() {
            $('#form').validate({
                submitHandler: function (form, e) {
                    e.preventDefault()

                    callApiWithForm(form)
                }
            })
        }
    </script>

@endpush
