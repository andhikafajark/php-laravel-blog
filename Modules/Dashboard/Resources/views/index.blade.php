@extends('components.tailwindcss.templates.admin')

@section('content')

    <h1 class="text-3xl font-bold text-gray-900 my-4">{{ $title }}</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div
            class="flex justify-between items-center gap-2 p-4 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Count Blog Category</h2>
            <h2 class="text-5xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $countBlogCategory ?? 0 }}</h2>
        </div>
        <div
            class="flex justify-between items-center gap-2 p-4 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Count Blog</h2>
            <h2 class="text-5xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $countBlog ?? 0 }}</h2>
        </div>
    </div>

@endsection
