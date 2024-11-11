<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="mb-4 text-2xl font-bold">{{ $group->name }}</h1>
    <p class="mb-2"><strong>Owner:</strong> {{ $group->owner->name }}</p>
    <p class="mb-4"><strong>Description:</strong> {{ $group->description ?? 'No description available' }}</p>

    <x-nav-link href="{{ route('guid') }}" class="text-black bg-gray-600">Back to Groups</x-nav-link>
</div>