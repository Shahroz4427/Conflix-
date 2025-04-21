<x-app-layout>

    <x-navbar />

    <div class="container-fluid py-4">
        <h4 class="fw-bold mb-3">{{ $lawyer->name }}</h4>

        <div class="bg-light rounded p-3 mb-4">
            <p class="text-muted mb-1">ID# {{ str_pad($lawyer->id, 2, '0', STR_PAD_LEFT) }}</p>

            @if ($lawyer->email)
            <p><strong>Email:</strong> <a href="mailto:{{ $lawyer->email }}">{{ $lawyer->email }}</a></p>
            @endif

            @if ($lawyer->phone_number)
            <p><strong>Phone:</strong> {{ $lawyer->phone_number }}</p>
            @endif

            @if ($lawyer->age)
            <p><strong>Age:</strong> {{ $lawyer->age }}</p>
            @endif

            @if ($lawyer->address)
            <p><strong>Address:</strong> {{ $lawyer->address }}</p>
            @endif

            @if ($lawyer->jurisdiction)
            <p><strong>Jurisdiction:</strong> {{ $lawyer->jurisdiction->title }}</p>
            @endif

            @if ($lawyer->additional_information)
            <p><strong>Additional Info:</strong> {{ $lawyer->additional_information }}</p>
            @endif

            <p><strong>Created on:</strong> {{ $lawyer->created_at->format('d M Y') }}</p>

            @if ($lawyer->company)
            <p><strong>Associated Company:</strong> {{ $lawyer->company->user->name ?? '-' }}</p>
            @endif
        </div>
    </div>
</x-app-layout>