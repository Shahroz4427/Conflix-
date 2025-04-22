<x-app-layout>
    <x-navbar/>
    <div class="container-fluid py-4">
        <h4 class="fw-bold mb-4 text-black">{{ $companyConflictLetterTemplate->title }}</h4>

        <div class="border rounded-3 p-4 mb-4 shadow-sm bg-white text-black">
            <p class="text-muted mb-2">ID# {{ str_pad($companyConflictLetterTemplate->id, 2, '0', STR_PAD_LEFT) }}</p>
            <p class="mb-2"><strong>Uploaded By:</strong> {{ $companyConflictLetterTemplate->uploaded_by ?? 'N/A' }}</p>
            <p class="mb-2"><strong>Uploaded On:</strong>
                {{ \Carbon\Carbon::parse($companyConflictLetterTemplate->uploaded_date)->format('d M Y') }}
            </p>
            <p class="mb-4"><strong>Status:</strong> {{ ucfirst($companyConflictLetterTemplate->status) }}</p>

            <h5 class="fw-bold mb-3">Description</h5>
            <p class="mb-4">{{ $companyConflictLetterTemplate->description ?? 'No description provided' }}</p>

            <h5 class="fw-bold mb-3">Template File</h5>
            @if($companyConflictLetterTemplate->upload_template)
                <a href="{{ asset('uploads/company_conflict_letter_templates/' . $companyConflictLetterTemplate->upload_template) }}"
                   target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-file-earmark-pdf"></i> View PDF
                </a>
            @else
                <span class="text-muted">No file uploaded</span>
            @endif
        </div>
    </div>
</x-app-layout>
