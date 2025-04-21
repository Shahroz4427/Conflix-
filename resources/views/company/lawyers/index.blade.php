<x-app-layout>

    <x-navbar buttonName="Add Lawyer" buttonUrl="{{ route('company.lawyers.create') }}"/>

    <div class="container-fluid py-4">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Search --}}
        <div class="row align-items-center shadow-lg bg-white rounded-3 mx-1 py-3 my-3">
            <div class="col-md-4 col-12 py-2 pe-0">
                <div class="input-group me-2">
                    <span class="input-group-text text-body">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="lawyerSearch" class="form-control bg-transparent"
                        placeholder="Search lawyers...">
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="table-responsive" id="lawyerTableWrapper">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-center text-xs opacity-7 px-3">
                                                Id</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Name</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Phone</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Email</th>

                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">
                                                Jurisdiction</th>

                                            <th class="text-center text-uppercase text-secondary text-xs opacity-7">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($lawyers as $lawyer)
                                        <tr>
                                            <td class="text-center px-3">
                                                <p class="text-sm mb-0">{{ $lawyer->id }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $lawyer->name }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $lawyer->phone_number ?? '—' }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $lawyer->email ?? '—' }}</p>
                                            </td>

                                            <td>
                                                <p class="text-sm mb-0">{{ $lawyer->jurisdiction->title ?? '—' }}</p>
                                            </td>

                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    {{-- Edit Icon --}}
                                                    <a href="{{ route('company.lawyers.edit', $lawyer->id) }}"
                                                        class="text-secondary text-sm" data-bs-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>

                                                    {{-- Show Detail Icon --}}
                                                    <a href="{{ route('company.lawyers.show', $lawyer->id) }}"
                                                        class="text-secondary text-sm" data-bs-toggle="tooltip"
                                                        title="Show Detail">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>

                                                    {{-- Delete Icon --}}
                                                    <form action="{{ route('company.lawyers.destroy', $lawyer->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this lawyer?');"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-link text-danger text-sm p-0 m-0"
                                                            data-bs-toggle="tooltip" title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No lawyers found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 mx-4">
                            {{ $lawyers->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('lawyerSearch');
        searchInput.addEventListener('input', function() {
            const value = this.value.toLowerCase();
            const rows = document.querySelectorAll('#lawyerTableWrapper tbody tr');
            rows.forEach(row => {
                const name = row.children[1].textContent.toLowerCase();
                const email = row.children[2].textContent.toLowerCase();
                if (name.includes(value) || email.includes(value)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    </script>
    @endpush
</x-app-layout>