<section class="bg-gray-200 h-screen min-w-full px-4">
    @if (session()->has('message'))
        <div class="w-full md:w-1/6 fixed top-2 right-2 text-lg font-semibold p-2 bg-green-500 text-white rounded text-center">
            {{ session('message') }}
        </div>
    @endif
    <div class="flex flex-col h-full justify-center">
        <div class="w-full max-w-2xl bg-white mx-auto shadow-md rounded border border-gray-300">
            <header class="px-4 py-2 flex justify-between">
                <h1 class="text-2xl font-mono font-bold">Users</h1>
                <button class="bg-blue-500 px-2 rounded text-white hover:bg-blue-900" wire:click="$set('showForm', {{ ! $showForm }})">
                    {{ $showForm ? 'Hide form' : 'Show form' }}
                </button>
            </header>
            @if($showForm)
                <div class="w-full px-4 py-2 space-y-1">
                    <div class="w-full">
                        <input class="w-full p-2 border @error('name') border-red-700 @enderror" type="text" placeholder="Username" wire:model="name">
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-full">
                        <input class="w-full p-2 border @error('email') border-red-700 @enderror" type="email" placeholder="E-mail" wire:model="email">
                        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end">
                        @if($updateMode)
                            <button class="bg-green-500 p-2 rounded text-white" wire:click="update">Execute</button>
                        @else
                            <button class="bg-green-500 p-2 rounded text-white" wire:click="store">Execute</button>
                        @endif
                    </div>
                </div>
            @endif

            <div class="p-3">
                <input type="text" placeholder="Search..." class="w-full px-4 py-2 border" wire:model="search">
                <table class="table-auto w-full mt-2">
                    <thead class="bg-gray-200">
                        <tr class="text-left">
                            <th class="p-2">
                                ID
                                @if($orderBy === 'desc')
                                    <button wire:click="$set('orderBy', 'asc')">
                                        <span>&#8595;</span>
                                    </button>
                                @else
                                    <button wire:click="$set('orderBy', 'desc')">
                                        <span>&#8593;</span>
                                    </button>
                                @endif
                            </th>
                            <th class="p-2">Name</th>
                            <th class="p-2">Email</th>
                            <th class="p-2"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-900">
                    @foreach($users as $user)
                        <tr>
                            <td class="p-2">{{ $user->id }}</td>
                            <td class="p-2">{{ $user->name }}</td>
                            <td class="p-2">{{ $user->email }}</td>
                            <td class="p-2 flex justify-end space-x-1">
                                <button class="p-1 bg-yellow-500 rounded text-white" wire:click="edit({{ $user->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="p-1 bg-red-500 rounded text-white" wire:click="delete({{ $user->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
{{--    <div class="flex justify-between shadow p-5 bg-blue-300">--}}
{{--        <h1 class="text-2xl">Users</h1>--}}
{{--        <button class="text-white bg-blue-700 hover:bg-blue-900 border px-2 py-2 rounded-3xl" wire:click="$set('showForm', {{ ! $showForm }})">--}}
{{--            {{ $showForm ? 'Hide form' : 'Show form' }}--}}
{{--        </button>--}}
{{--    </div>--}}

{{--    @if($showForm)--}}
{{--        <div class="w-full py-2 border-b-2 border-gray-700">--}}
{{--            <div class="flex flex-col md:flex-row space-y-1 md:space-y-0 md:space-x-3">--}}
{{--                <div class="w-full md:w-1/3">--}}
{{--                    <input class="w-full p-2 rounded shadow focus-within:bg-blue-50 @error('name') border-2 border-red-700 @else border border-blue-700 @enderror" type="text" placeholder="username" wire:model="name">--}}
{{--                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror--}}
{{--                </div>--}}
{{--                <div class="w-full md:w-1/3">--}}
{{--                    <input class="w-full p-2 rounded shadow focus-within:bg-blue-50 @error('email') border-2 border-red-700 @else border border-blue-700 @enderror" type="email" placeholder="email" wire:model="email">--}}
{{--                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror--}}
{{--                </div>--}}

{{--                <div class="flex justify-end flex-1">--}}
{{--                    @if($updateMode)--}}
{{--                        <button class="bg-green-500 px-4 py-2 rounded items-end text-white" wire:click="update">Execute</button>--}}
{{--                    @else--}}
{{--                        <button class="bg-green-500 px-4 py-2 rounded items-end text-white" wire:click="store">Execute</button>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <div class="w-full mt-5">--}}
{{--        <div class="flex justify-end">--}}
{{--            <input type="text" placeholder="Search..." class="w-full md:w-1/3 items-end px-4 py-2 border" wire:model="search">--}}
{{--        </div>--}}
{{--        <ul class="flex h-12 border-b items-center">--}}
{{--            <li class="w-1/4 hidden md:block w-1/4">--}}
{{--                ID--}}
{{--                @if($orderBy === 'desc')--}}
{{--                    <button wire:click="$set('orderBy', 'asc')">--}}
{{--                        <span>&#8595;</span>--}}
{{--                    </button>--}}
{{--                @else--}}
{{--                    <button wire:click="$set('orderBy', 'desc')">--}}
{{--                        <span>&#8593;</span>--}}
{{--                    </button>--}}
{{--                @endif--}}
{{--            </li>--}}
{{--            <li class="hidden md:block w-1/4">NAME</li>--}}
{{--            <li class="w-1/4">EMAIL</li>--}}
{{--            <li class="w-1/4"></li>--}}
{{--        </ul>--}}
{{--        @foreach($users as $user)--}}
{{--            <ul class="flex h-12 border-b items-center">--}}
{{--                <li class="w-1/4 hidden md:block w-1/4">{{ $user->id }}</li>--}}
{{--                <li class="hidden md:block w-1/4">{{ $user->name }}</li>--}}
{{--                <li class="w-1/4">{{ $user->email }}</li>--}}
{{--                <ul class="flex justify-end space-x-1 w-1/4 flex-1">--}}
{{--                    <li><button class="p-1 bg-yellow-500 md:px-2 rounded" wire:click="edit({{ $user->id }})">Edit</button></li>--}}
{{--                    <li><button class="p-1 bg-red-500 md:px-2 rounded" wire:click="delete({{ $user->id }})">Delete</button></li>--}}
{{--                </ul>--}}
{{--            </ul>--}}
{{--        @endforeach--}}
{{--        <div class="mt-2">--}}
{{--            {{ $users->links() }}--}}
{{--        </div>--}}
{{--    </div>--}}

</section>
