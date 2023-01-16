<div class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        @if (auth()->user()->role == 2)
            <div class="flex gap-7 items-center mb-10">
                <h1 class="text-2xl font-semibold text-white">Hello {{ auth()->user()->username }}, You are affiliator !</h1>

                <div class="">
                    <x-primary-button type="button" onclick="document.querySelector('#linkCreate').click()" class="w-full rounded-full py-3">
                        Make New Class
                    </x-primary-button>
                    <a href="{{ route('class.create') }}" id="linkCreate" class="hidden"></a>
                </div>
            </div>
        @endif

        {{-- Filter --}}
        <div class="flex justify-between">
            <select wire:model="order" class="text-xs sm:text-sm rounded-full w-40 px-4 py-3 bg-slate-900 border-green-500 placeholder-gray-400 text-gray-300 focus:border-green-500 hover:cursor-pointer">
                <option value="best-seller">Best Seller</option>
                <option value="newest">Newest</option>
            </select>

            <input type="text" wire:model="search" placeholder="Search..." class="text-xs sm:text-sm w-44 sm:w-60 md:w-80 px-4 border-green-500 bg-slate-900 text-gray-300 focus:border-green-600 focus:ring-green-600 rounded-full">
        </div>

        {{-- Card List --}}
        <div class="my-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($courses as $key => $course) 
                <a href="{{ route('class.detail', ['course' => $course]) }}" class="h-full max-w-sm">
                    <div wire:key="{{ $key }}" class="flex mx-auto flex-col justify-between h-full w-full shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 hover:dark:bg-slate-700 transition duration-300 ease-in-out">
                        <div class="h-52 overflow-hidden">
                            <img class="rounded-t-xl w-full h-auto" src="{{ asset('storage/courses/thumbnails/'.$course->thumbnail) }}" alt="" />
                        </div>
                        <div class="p-5 flex flex-col justify-between grow">
                            <div class="mb-5">
                                <h5 class="mb-1 font-medium text-base sm:text-xl tracking-tight text-white">{{ $course->title }}</h5>
                                <p class="mb-3 font-normal text-xs sm:text-sm text-gray-400">
                                    {!! nl2br(e(strlen($course->description) > 200 ? substr($course->description, 0, 80).'...' : $course->description)) !!}    
                                </p>
                            </div>

                            <div class="grid grid-cols-2 items-end">
                                <div class="flex flex-col text-gray-500 text-sm">
                                    <small><i class="text-base uil uil-video"></i> {{ $course->course_items_count }} videos</small>
                                    <small><i class="text-base uil uil-clock"></i> {{ date('G\h i\m', strtotime($course->duration)) }} duration</small>
                                </div>

                                <h4 class="text-lg font-medium text-green-500 text-right"><span class="text-sm">Rp</span> {{ number_format($course->price, 2, ',', '.') }}</h4>
                                
                                {{-- <x-primary-button class="w-full rounded-md dark:bg-transparent dark:border-green-500 dark:text-emerald-500 hover:dark:text-white py-3">Start Course</x-primary-button> --}}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach 
        </div>

        {{ $courses->links('pagination::tailwind') }}
    </div>
</div>