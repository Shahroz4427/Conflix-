<x-app-layout>

    <x-navbar />

    <div class="container-fluid py-4">
        <h4 class="fw-bold mb-3 text-black">{{ $lawyer->name }}</h4>

        <div class="border rounded-3 p-4 mb-4 shadow-sm bg-white text-black">
            <p class="text-muted mb-2">ID# {{ str_pad($lawyer->id, 2, '0', STR_PAD_LEFT) }}</p>

            @if ($lawyer->email)
            <p class="mb-2"><strong>Email:</strong> <a href="mailto:{{ $lawyer->email }}">{{ $lawyer->email }}</a></p>
            @endif

            @if ($lawyer->phone_number)
            <p class="mb-2"><strong>Phone:</strong> {{ $lawyer->phone_number }}</p>
            @endif

            @if ($lawyer->age)
            <p class="mb-2"><strong>Age:</strong> {{ $lawyer->age }}</p>
            @endif

            @if ($lawyer->address)
            <p class="mb-2"><strong>Address:</strong> {{ $lawyer->address }}</p>
            @endif

            @if ($lawyer->jurisdiction)
            <p class="mb-2"><strong>Jurisdiction:</strong> {{ $lawyer->jurisdiction->title }}</p>
            @endif

            @if ($lawyer->additional_information)
            <p class="mb-2"><strong>Additional Info:</strong> {{ $lawyer->additional_information }}</p>
            @endif

            <p class="mb-2"><strong>Created on:</strong> {{ $lawyer->created_at->format('d M Y') }}</p>

            @if ($lawyer->company)
            <p class="mb-0"><strong>Associated Company:</strong> {{ $lawyer->company->user->name ?? '-' }}</p>
            @endif
        </div>
    </div>
</x-app-layout>
