<div class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <form wire:submit.prevent="update" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div>
                    <h1 class="text-3xl text-white mb-3">Class</h1>
        
                    <x-card class="flex flex-col sm:flex-row sm:justify-between sm:gap-10 p-6">
                        <div class="w-full">
                            <div class="mb-5">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input wire:model.defer="inputCourse.title" id="title" class="block mt-1 w-full" type="text" required autofocus />
                                <x-input-error :messages="$errors->get('inputCourse.title')" class="mt-2" />
                            </div>
            
                            <div class="mb-5">
                                <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                                <input type="file" wire:model.defer="inputCourse.thumbnail" id="thumbnail" class="my-1">
                                @if ($inputCourse['thumbnail'])
                                    <img src="{{ $inputCourse['thumbnail']->temporaryUrl() }}">
                                @else
                                    <img src="{{ asset('storage/courses/thumbnails/'.$course->thumbnail) }}" alt="">
                                @endif
                                <x-input-error :messages="$errors->get('inputCourse.thumbnail')" class="mt-2" />
                            </div>

                            <div class="mb-5">
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input wire:model.defer="inputCourse.price" id="price" class="block mt-1 w-full" type="number" required />
                                <x-input-error :messages="$errors->get('inputCourse.price')" class="mt-2" />
                            </div>
            
                            <div class="mb-5">
                                <x-input-label for="description" :value="__('Description (optional)')" />
                                <x-textarea-input rows="5" wire:model.defer="inputCourse.description" id="description" class="block mt-1 w-full" type="text" />
                                <x-input-error :messages="$errors->get('inputCourse.description')" class="mt-2" />
                            </div>
                        </div>
                    </x-card>
                </div>
        
                <div>
                    <h1 class="text-3xl text-white mb-3">Class Videos</h1>
        
                    @foreach ($inputCourseItems as $key => $item)
                        <x-card wire:key="{{ $key }}" class="flex flex-col sm:flex-row sm:justify-between sm:gap-10 p-6 mb-6">
                            <div>
                                <div class="mb-5">
                                    <x-input-label for="itemTitle_{{$key}}" :value="__('Video Title')" />
                                    <x-text-input wire:model.defer="inputCourseItems.{{$key}}.title" id="itemTitle_{{$key}}" class="block mt-1 w-full" type="text"/>
                                    @error('inputCourseItems.'.$key.'.title')
                                        <span class="block text-sm text-red-600 dark:text-red-400 space-y-1 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <div class="mb-5">
                                    <x-input-label for="itemVideo_{{$key}}" :value="__('Video')" />
                                    <input type="file" wire:model.defer="inputCourseItems.{{$key}}.video" id="itemVideo_{{$key}}" accept="video/*">
                                    @error('inputCourseItems.'.$key.'.video')
                                        <span class="block text-sm text-red-600 dark:text-red-400 space-y-1 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="self-end sm:self-start">
                                <x-danger-button wire:click="removeItem({{$key}})" type="button">
                                    <i class="uil uil-trash-alt"></i>
                                </x-danger-button>
                            </div>
                        </x-card>
                    @endforeach
        
                    <div class="flex justify-end">
                        <x-primary-button wire:click="newItem()" type="button">
                            <i class="uil uil-plus"></i> New Item
                        </x-primary-button>
                    </div>
                </div>
            </div>

            <x-primary-button class="my-10 py-5 w-full">
                Edit Class
            </x-primary-button>
        </form>
    </div>
</div>