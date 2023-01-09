<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{openCreate: false}" x-cloak class="grid grid-cols-4 grid-flow-col gap-10">
                <div class="col-span-1">
                    <x-primary-button @click="openCreate = true" class="mb-3">
                        Create Discussion
                    </x-primary-button>

                    <x-card>
                        <div class="p-6">
                            {{ __("You're logged in!") }}
                        </div>
                    </x-card>
                </div>

                <div class="col-span-3">
                    <div @card-closed.window="openCreate = $event.detail.openCreate" x-show="openCreate" class="mb-5" x-transitio>
                        @livewire('threads.thread-create')
                    </div>
                    
                    @livewire('threads.thread-list')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
