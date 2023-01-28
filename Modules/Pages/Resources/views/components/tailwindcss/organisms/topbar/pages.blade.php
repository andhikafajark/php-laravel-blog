<!-- Text Header -->
<header class="w-full container mx-auto">
    <div class="flex flex-col items-center py-12">
        <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="{{ route('/') }}">
            {{ env('APP_NAME') }}
        </a>
    </div>
</header>

<!-- Topic Nav -->
<nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
    <div class="block sm:hidden">
        <a
            href="#"
            class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
            @click="open = !open"
        >
            Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
        </a>
    </div>
    <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
        <div
            class="w-full container mx-auto flex flex-col sm:flex-row items-center text-sm font-bold uppercase mt-0 px-6 py-2 overflow-x-auto">

            @forelse($categories as $item)

                <a href="{{ route('/', ['category' => $item->slug]) }}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">{{ $item->title }}</a>

            @empty
            @endforelse

        </div>
    </div>
</nav>
