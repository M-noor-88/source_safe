<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Group') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                This is from resource/views/guid.blade.php <br>
                And this is the Component ('&#x1F981;')
                <livewire:groups.group-details :groupId="$group['id']" />
            </div>
        </div>
    </div>
</x-app-layout>