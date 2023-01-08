@extends(($module->getLowerName() ?? '') . '::components.tailwindcss.templates.pages')

@section('content')

    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            <article class="w-full flex flex-col shadow my-4">
                <img
                    src="{{ $blog->headlineImage && Storage::exists($blog->headlineImage->path . $blog->headlineImage->hash_name) ? asset(Storage::url($blog->headlineImage->path . $blog->headlineImage->hash_name)) : '' }}"
                    class="max-h-[500px] block rounded-lg mx-auto"/>
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="#"
                       class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $blog->blogCategory->title ?? '' }}</a>
                    <p class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $blog->title ?? '' }}</p>
                    <p class="text-sm pb-8">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{ $blog->creator->name ?? '' }}</a>,
                        Published on {{ ($blog->created_at ?? null) ? $blog->created_at->format('d F Y') : '' }}
                    </p>
                    <div>{!!  $blog->content ?? '' !!}</div>
                </div>
            </article>

            <div class="w-full flex pt-6">
                <a href="#" class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
                    <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i>
                        Previous</p>
                    <p class="pt-2">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</p>
                </a>
                <a href="#" class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
                    <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i
                            class="fas fa-arrow-right pl-1"></i></p>
                    <p class="pt-2">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</p>
                </a>
            </div>

            {{--        <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">--}}
            {{--            <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">--}}
            {{--                <img src="https://source.unsplash.com/collection/1346951/150x150?sig=1" class="rounded-full shadow h-32 w-32">--}}
            {{--            </div>--}}
            {{--            <div class="flex-1 flex flex-col justify-center md:justify-start">--}}
            {{--                <p class="font-semibold text-2xl">David</p>--}}
            {{--                <p class="pt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel neque non libero suscipit suscipit eu eu urna.</p>--}}
            {{--                <div class="flex items-center justify-center md:justify-start text-2xl no-underline text-blue-800 pt-4">--}}
            {{--                    <a class="" href="#">--}}
            {{--                        <i class="fab fa-facebook"></i>--}}
            {{--                    </a>--}}
            {{--                    <a class="pl-4" href="#">--}}
            {{--                        <i class="fab fa-instagram"></i>--}}
            {{--                    </a>--}}
            {{--                    <a class="pl-4" href="#">--}}
            {{--                        <i class="fab fa-twitter"></i>--}}
            {{--                    </a>--}}
            {{--                    <a class="pl-4" href="#">--}}
            {{--                        <i class="fab fa-linkedin"></i>--}}
            {{--                    </a>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}

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
            {{--                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=9">--}}
            {{--            </div>--}}
            {{--            <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">--}}
            {{--                <i class="fab fa-instagram mr-2"></i> Follow @dgrzyb--}}
            {{--            </a>--}}
            {{--        </div>--}}

        </aside>

    </div>

@endsection
