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
                    <div class="flex gap-2 mb-3">

                        @forelse($blog->categories as $category)

                            <a href="{{ route('/', ['category' => $category->slug]) }}"
                               class="bg-sky-300 text-sm font-bold capitalize rounded-xl px-3 py-1">{{ $category->title }}</a>

                        @empty @endforelse

                    </div>
                    <p class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $blog->title ?? '' }}</p>
                    <p class="text-sm pb-8">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{ $blog->creator->name ?? '' }}</a>,
                        Published on {{ ($blog->created_at ?? null) ? $blog->created_at->format('d F Y') : '' }}
                    </p>
                    <div>{!!  $blog->content ?? '' !!}</div>
                </div>
            </article>
            <section class="w-full bg-gray-100 rounded-xl p-2">
                <h2 class="text-xl font-bold mb-2">Comments</h2>
                <hr>
                <form id="form" action="{{ route('blog.comment', $blog) }}" method="post" class="mt-3">

                    @method('put')

                    <div class="mb-3">
                        <textarea id="comment" rows="4" name="comment"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Enter a comment ..." required></textarea>
                        <label id="comment-error" class="error text-xs text-red-500" for="comment"></label>
                    </div>
                    <div class="flex justify-end mb-3">
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            Comment
                        </button>
                    </div>
                </form>
                <div class="flex flex-col items-center justify-center antialiased bg-gray-100 w-full rounded-xl">

                    @forelse($blog->comments as $comment)

                        <div
                            class="flex-col w-full py-4 bg-white border-b-2 border-r-2 border-gray-200 sm:px-4 sm:py-4 md:px-4 sm:rounded-lg sm:shadow-sm mb-2">
                            <div class="flex flex-row">
                                <img class="object-cover w-12 h-12 border-2 border-gray-300 rounded-full"
                                     alt="Noob master's avatar"
                                     src="https://images.unsplash.com/photo-1517070208541-6ddc4d3efbcb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&faces=1&faceindex=1&facepad=2.5&w=500&h=500&q=80">
                                <div class="flex-col mt-1">
                                    <div
                                        class="flex items-center flex-1 px-4 font-bold leading-tight">{{ $comment->creator->name ?? 'Anonymous' }}
                                        <span
                                            class="ml-2 text-xs font-normal text-gray-500">{{ ($comment->created_at ?? null) ? $comment->created_at->diffForHumans() : '' }}</span>
                                    </div>
                                    <div
                                        class="flex-1 px-2 ml-2 text-sm font-medium leading-loose text-gray-600">{{ $comment->comment ?? '' }}</div>
                                    <button class="inline-flex items-center px-1 pt-2 ml-1 flex-column"
                                            data-type="reply-button" data-parent-id="{{ $comment->id  }}"
                                            data-index="0">
                                        <svg
                                            class="w-5 h-5 ml-2 text-gray-600 cursor-pointer fill-current hover:text-gray-900"
                                            viewBox="0 0 95 78" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M29.58 0c1.53.064 2.88 1.47 2.879 3v11.31c19.841.769 34.384 8.902 41.247 20.464 7.212 12.15 5.505 27.83-6.384 40.273-.987 1.088-2.82 1.274-4.005.405-1.186-.868-1.559-2.67-.814-3.936 4.986-9.075 2.985-18.092-3.13-24.214-5.775-5.78-15.377-8.782-26.914-5.53V53.99c-.01 1.167-.769 2.294-1.848 2.744-1.08.45-2.416.195-3.253-.62L.85 30.119c-1.146-1.124-1.131-3.205.032-4.312L27.389.812c.703-.579 1.49-.703 2.19-.812zm-3.13 9.935L7.297 27.994l19.153 18.84v-7.342c-.002-1.244.856-2.442 2.034-2.844 14.307-4.882 27.323-1.394 35.145 6.437 3.985 3.989 6.581 9.143 7.355 14.715 2.14-6.959 1.157-13.902-2.441-19.964-5.89-9.92-19.251-17.684-39.089-17.684-1.573 0-3.004-1.429-3.004-3V9.936z"
                                                fill-rule="nonzero"/>
                                        </svg>
                                    </button>
                                    <button class="inline-flex items-center px-1 -ml-1 flex-column">
                                        <svg class="w-5 h-5 text-gray-600 cursor-pointer hover:text-gray-700"
                                             fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            @if($comment->children->isNotEmpty())
                                @forelse($comment->children as $children)
                                    @include(($module->getLowerName() ?? '') . '::components.tailwindcss.molecules.reply-comment', [
                                        'index' => 1,
                                        'comment' => $children
                                    ])
                                @empty @endforelse
                            @endif

                        </div>

                    @empty @endforelse

                </div>
            </section>
            <div class="w-full flex pt-6 justify-between">

                @if($previous)

                    <a href="{{ route('pages.blog', $previous) }}"
                       class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
                        <p class="text-lg text-blue-800 font-bold flex items-center">
                            <i class="fas fa-arrow-left pr-1"></i> Previous
                        </p>
                        <p class="pt-2">{{ $previous->title ?? '' }}</p>
                    </a>

                @else

                    <div></div>

                @endif
                @if($next)

                    <a href="{{ route('pages.blog', $next) }}"
                       class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
                        <p class="text-lg text-blue-800 font-bold flex items-center justify-end">
                            Next <i class="fas fa-arrow-right pl-1"></i>
                        </p>
                        <p class="pt-2">{{ $next->title ?? '' }}</p>
                    </a>

                @endif

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

@push('scripts')

    <script>
        $(document).ready(function () {
            handler()
        })

        function handler() {
            $('#form').validate({
                submitHandler: function (form, e) {
                    e.preventDefault()

                    callApiWithForm(form, {
                        success: function (response) {
                            if (response?.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: response?.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                $(form).trigger('reset')
                            }
                        },
                    })
                }
            })

            $('button[data-type="reply-button"]').on('click', function () {
                const parentElement = $(this).closest('.flex')

                if (parentElement.siblings('form[data-type="form-comment-reply"]').length > 0) {
                    $('body form[data-type="form-comment-reply"]').remove()

                    return;
                }

                $('body form[data-type="form-comment-reply"]').remove()

                const parentId = $(this).data('parent-id')
                const index = $(this).data('index')

                const formComment = `
                    <form action="{{ route('blog.comment', $blog) }}" method="post" data-type="form-comment-reply" style="margin-left: ${4 * index}rem">
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="parent_id" value="${parentId}">
                        <div class="mb-3">
                            <textarea id="comment" rows="4" name="comment"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter a comment ..." required></textarea>
                            <label id="comment-error" class="error text-xs text-red-500" for="comment"></label>
                        </div>
                        <div class="flex justify-end mb-3">
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                Comment
                            </button>
                        </div>
                    </form>`

                parentElement.after(formComment)
            })

            $('body').on('submit', 'form[data-type="form-comment-reply"]', function (e) {
                e.preventDefault()

                const form = this

                callApiWithForm(form, {
                    success: function (response) {
                        if (response?.success) {
                            Swal.fire({
                                icon: 'success',
                                title: response?.message,
                                showConfirmButton: false,
                                timer: 1500
                            })

                            $(form).trigger('reset')
                        }
                    },
                })
            })
        }
    </script>

@endpush
