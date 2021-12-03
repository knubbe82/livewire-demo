<div class="p-2">
    @if (session()->has('message'))
        <div class="w-full md:w-1/6 fixed bottom-1 right-1 text-lg font-semibold p-3 bg-green-500 text-white rounded-3xl text-center">
            {{ session('message') }}
        </div>
    @endif
    <div class="flex justify-between shadow p-5 bg-blue-300">
        <h1 class="text-2xl">Users</h1>
        <button class="text-white bg-blue-700 hover:bg-blue-900 border px-2 py-2 rounded-3xl" wire:click="$set('showForm', {{ ! $showForm }})">
            {{ $showForm ? 'Hide form' : 'Show form' }}
        </button>
    </div>

    @if($showForm)
        <div class="w-full py-2 border-b-2 border-gray-700">
            <div class="flex flex-col md:flex-row space-y-1 md:space-y-0 md:space-x-3">
                <div class="w-full md:w-1/3">
                    <input class="w-full p-2 rounded shadow focus-within:bg-blue-50 @error('name') border-2 border-red-700 @else border border-blue-700 @enderror" type="text" placeholder="username" wire:model="name">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="w-full md:w-1/3">
                    <input class="w-full p-2 rounded shadow focus-within:bg-blue-50 @error('email') border-2 border-red-700 @else border border-blue-700 @enderror" type="email" placeholder="email" wire:model="email">
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end flex-1">
                    @if($updateMode)
                        <button class="bg-green-500 px-4 py-2 rounded items-end text-white" wire:click="update">Execute</button>
                    @else
                        <button class="bg-green-500 px-4 py-2 rounded items-end text-white" wire:click="store">Execute</button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="w-full mt-5">
        <div class="flex justify-end">
            <input type="text" placeholder="Search..." class="w-full md:w-1/3 items-end px-4 py-2 border" wire:model="search">
        </div>
        <ul class="flex h-12 border-b items-center">
            <li class="w-1/4 hidden md:block w-1/4">
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
            </li>
            <li class="hidden md:block w-1/4">NAME</li>
            <li class="w-1/4">EMAIL</li>
            <li class="w-1/4"></li>
        </ul>
        @foreach($users as $user)
            <ul class="flex h-12 border-b items-center">
                <li class="w-1/4 hidden md:block w-1/4">{{ $user->id }}</li>
                <li class="hidden md:block w-1/4">{{ $user->name }}</li>
                <li class="w-1/4">{{ $user->email }}</li>
                <ul class="flex justify-end space-x-1 w-1/4 flex-1">
                    <li><button class="p-1 bg-yellow-500 md:px-2 rounded" wire:click="edit({{ $user->id }})">Edit</button></li>
                    <li><button class="p-1 bg-red-500 md:px-2 rounded" wire:click="delete({{ $user->id }})">Delete</button></li>
                </ul>
            </ul>
        @endforeach
        <div class="mt-2">
            {{ $users->links() }}
        </div>
    </div>

</div>
