<x-app-layout :routePrefix="auth()->user()->user_type=='admin' ? 'admin' : 'company'">
    <div class="container-fluid py-4">
        <h4 class="fw-bold mb-3">{{ $client->name }}</h4>

        <div class="bg-light rounded p-3 mb-4">
            <p class="text-muted mb-1">ID# {{ str_pad($client->id, 2, '0', STR_PAD_LEFT) }}</p>
            
            @if ($client->email)
                <p><strong>Email:</strong> <a href="mailto:{{ $client->email }}">{{ $client->email }}</a></p>
            @endif

            @if ($client->phone_number)
                <p><strong>Phone:</strong> {{ $client->phone_number }}</p>
            @endif

            @if ($client->age)
                <p><strong>Age:</strong> {{ $client->age }}</p>
            @endif

            @if ($client->address)
                <p><strong>Address:</strong> {{ $client->address }}</p>
            @endif

            @if ($client->additional_information)
                <p><strong>Additional Info:</strong> {{ $client->additional_information }}</p>
            @endif

            <p><strong>Created on:</strong> {{ $client->created_at->format('d M Y') }}</p>

            @if ($client->company)
                <p><strong>Associated Company:</strong> {{ $client->company->user->name ?? '-' }}</p>
            @endif
        </div>
    </div>
</x-app-layout>
