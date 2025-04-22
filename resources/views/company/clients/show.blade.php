<x-app-layout>
    
    <x-navbar/>

    <div class="container-fluid py-4">
        <h4 class="fw-bold mb-3 text-black">{{ $client->name }}</h4>

        <div class="border rounded-3 p-4 mb-4 shadow-sm bg-white text-black">
            <p class="text-muted mb-2">ID# {{ str_pad($client->id, 2, '0', STR_PAD_LEFT) }}</p>

            @if ($client->email)
            <p class="mb-2"><strong>Email:</strong> <a href="mailto:{{ $client->email }}">{{ $client->email }}</a></p>
            @endif

            @if ($client->phone_number)
            <p class="mb-2"><strong>Phone:</strong> {{ $client->phone_number }}</p>
            @endif

            @if ($client->age)
            <p class="mb-2"><strong>Age:</strong> {{ $client->age }}</p>
            @endif

            @if ($client->address)
            <p class="mb-2"><strong>Address:</strong> {{ $client->address }}</p>
            @endif

            @if ($client->additional_information)
            <p class="mb-2"><strong>Additional Info:</strong> {{ $client->additional_information }}</p>
            @endif

            <p class="mb-2"><strong>Created on:</strong> {{ $client->created_at->format('d M Y') }}</p>

            @if ($client->company)
            <p class="mb-0"><strong>Associated Company:</strong> {{ $client->company->user->name ?? '-' }}</p>
            @endif
        </div>
    </div>
</x-app-layout>
