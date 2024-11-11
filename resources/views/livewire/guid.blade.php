<div class="p-6 bg-white rounded-lg shadow-md">
    <x-button wire:click="showCreateModal" class="mb-4">
        Create Group
    </x-button>

    <x-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Create New Group') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="groupName" value="{{ __('Group Name') }}" />
                <x-input id="groupName" type="text" class="block w-full mt-1" wire:model.defer="groupName" />
                @error('groupName') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="createGroup">
                {{ __('Create') }}
            </x-button>
            <x-secondary-button wire:click="closeCreateModal" class="ml-2">
                {{ __('Cancel') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    @if (session()->has('message'))
    <div class="mt-4 text-green-600">
        {{ session('message') }}
    </div>
    @endif

    @if (session()->has('error'))
    <div class="mt-4 text-red-600">
        {{ session('error') }}
    </div>
    @endif

    <div class="mt-6">
        <h2 class="text-lg font-semibold">All Groups</h2>
        <ul class="mt-2">
            @foreach ($allGroups as $group)
            <li class="flex justify-between p-2 mb-2 bg-gray-100 rounded-md ">
                <span>{{ $group['name'] }}</span>
                
                <span>
                <x-nav-link :href="route('groups.show', $group['id'])" class="ml-4 text-black bg-amber-600 hover:bg-red-700 ">
                    Show
                </x-nav-link>
                <span>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="mt-6">
        <h2 class="text-lg font-semibold">My Groups</h2>
        <ul class="mt-2">
            @if (empty($userGroups))
            <li class="p-2 bg-gray-100 rounded-md">You have no groups.</li>
            @else
            @foreach ($userGroups as $group)
            <li class="flex items-center justify-between p-2 mb-2 bg-gray-100 rounded-md">
                <span>{{ $group['name'] }}</span>
                
                <span>
                <x-button wire:click="deleteGroup({{ $group['id'] }})" class="ml-4 text-white bg-red-600 hover:bg-red-700 ">
                    Delete
                </x-button>

                <x-nav-link :href="route('groups.show', $group['id'])" class="ml-4 text-black bg-amber-600 hover:bg-red-700 ">
                    Show
                </x-nav-link>
                </span>
            </li>
            @endforeach
            @endif
        </ul>
    </div>
</div>