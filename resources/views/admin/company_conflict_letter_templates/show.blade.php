<x-app-layout :routePrefix="auth()->user()->user_type=='admin' ? 'admin' : 'company'">
    <div class="container-fluid py-4">
        <h4 class="fw-bold mb-3">{{ $companyConflictLetterTemplate->title }}</h4>

        <div class="bg-light rounded p-3 mb-4">
            <p class="text-muted mb-1">ID# {{ str_pad($companyConflictLetterTemplate->id, 2, '0', STR_PAD_LEFT) }}</p>
            <p><strong>Uploaded By:</strong> {{ $companyConflictLetterTemplate->uploaded_by ?? 'N/A' }}</p>
            <p><strong>Uploaded On:</strong> {{ \Carbon\Carbon::parse($companyConflictLetterTemplate->uploaded_date)->format('d M Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($companyConflictLetterTemplate->status) }}</p>

            <h5 class="fw-bold mb-2">Description</h5>
            <p>{{ $companyConflictLetterTemplate->description ?? 'No description provided' }}</p>

            <h5 class="fw-bold mb-2">Template File</h5>
            @if($companyConflictLetterTemplate->upload_template)
                <a href="{{ asset('uploads/company_conflict_letter_templates/' . $companyConflictLetterTemplate->upload_template) }}"
                   target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                    <i class="bi bi-file-earmark-pdf"></i> View PDF
                </a>
            @else
                <span class="text-muted">No file uploaded</span>
            @endif
        </div>
    </div>
</x-app-layout>
