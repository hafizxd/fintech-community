<div class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="my-5 overflow-x-auto">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full text-sm text-gray-400">
                        <thead class="bg-gray-800 text-xs uppercase font-medium">
                            <tr>
                                <th class="px-6 py-3 text-left tracking-wider">#</th>
                                <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                    User
                                </th>
                                <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                    Credit
                                </th>
                                <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800">
                            @php $counter = 1; @endphp
                            @foreach ($users as $user)
                                <tr class="bg-black bg-opacity-20">
                                    <td class="px-6 py-3">{{ $counter }}</td>
                                    <td class="flex items-center px-6 py-4 whitespace-nowrap">
                                        <img 
                                            class="w-10 h-10 rounded-full" 
                                            src="{{ isset($user->avatar) ? asset('storage/avatars/'.$user->avatar) : asset('assets/images/avatar-default.png') }}" 
                                            alt="User avatar"> 
                                            <span class="ml-2 font-medium">{{ $user->username }}</span>
                                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->credit }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($user->role == 1)
                                            Regular user
                                        @elseif ($user->role == 2)
                                            Mentor
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($user->role == 1)
                                            <x-primary-button wire:click="upgradeUser({{ $user->id }})" class="bg-white  border-2 rounded-md">Upgrade to Mentor</x-primary-button>
                                        @else 
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @php $counter++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{ $users->links('pagination::tailwind') }}
    </div>
</div>
