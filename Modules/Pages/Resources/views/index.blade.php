@extends(($module->getLowerName() ?? '') . '::components.tailwindcss.templates.pages')

@section('content')

    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            @forelse($blogs as $item)

                <article class="w-full flex flex-col shadow my-4">
                    <a href="{{ route('pages.blog', $item) }}" class="hover:opacity-75">
                        <img
                            src="{{ $item->headlineImage && Storage::exists($item->headlineImage->path . $item->headlineImage->hash_name) ? asset(Storage::url($item->headlineImage->path . $item->headlineImage->hash_name)) : '' }}"
                            class="max-h-[500px] block rounded-lg mx-auto hover:opacity-75"/>
                    </a>
                    <div class=" bg-white flex flex-col justify-start p-6">
                        <div class="flex gap-2 mb-3">

                            @forelse($item->categories as $category)

                                <a href="{{ route('/', ['category' => $category->slug]) }}" class="bg-sky-300 text-sm font-bold capitalize rounded-xl px-3 py-1">{{ $category->title }}</a>

                            @empty @endforelse

                        </div>
                        <a href="{{ route('pages.blog', $item) }}"
                           class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $item->title ?? '' }}</a>
                        <p class="text-sm pb-3">
                            By <a href="#"
                                  class="font-semibold hover:text-gray-800">{{ $item->creator->name ?? '' }}</a>,
                            Published
                            on {{ ($item->created_at ?? null) ? $item->created_at->format('d F Y') : '' }}
                        </p>
                        <p class="pb-6">{!!  $item->content ?? '' !!}</p>
                        <a href="{{ route('pages.blog', $item) }}" class="uppercase text-gray-800 hover:text-black">
                            Continue Reading <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>

            @empty

                <h5>Data Not Found</h5>

            @endforelse

            <div class="w-full">

                {{ $blogs->links('pagination::tailwind') ?? '' }}

            </div>
        </section>

        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">About Us</p>
                <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                    sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
                <a href="#"
                   class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                    Get to know us
                </a>
            </div>

            {{--        <div class="w-full bg-white shadow flex flex-col my-4 p-6">--}}
            {{--            <p class="text-xl font-semibold pb-5">Instagram</p>--}}
            {{--            <div class="grid grid-cols-3 gap-3">--}}
            {{--                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=1">--}}
            {{--                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=2">--}}
            {{--                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=3">--}}
            {{--                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=4">--}}
            {{--                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=5">--}}
            {{--                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=6">--}}
            {{--                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=7">--}}
            {{--                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=8">--}}
            {{--                <img class="hover:opacity-75" srcr="https://source.unsplash.com/collection/1346951/150x150?sig=9">--}}
            {{--            </div>--}}
            {{--            <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">--}}
            {{--                <i class="fab fa-instagram mr-2"></i> Follow @dgrzyb--}}
            {{--            </a>--}}
            {{--        </div>--}}

        </aside>

    </div>

@endsection


