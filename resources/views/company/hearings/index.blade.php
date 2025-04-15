<x-app-layout :routePrefix="auth()->user()->user_type=='admin' ? 'admin' : 'company'" navBarAddBtn="Add Hearing">
    <div class="container-fluid py-4">
        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-2">
            <div class="col-12">
                <div class="row px-3">
                    <div class="col-12">
                        <h4 class="text-black fs-5 mb-0">Case Hearings</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Search --}}
        <div class="row align-items-center shadow-lg bg-white rounded-3 mx-1 py-3 my-3">
            <div class="col-md-4 col-12 py-2 pe-0">
                <div class="d-flex align-items-center">
                    <div class="input-group me-2">
                        <span class="input-group-text text-body">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="hearingSearch" class="form-control bg-transparent"
                            placeholder="Search by court or case ID...">
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div id="hearingTableWrapper">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-center text-xs opacity-7 px-3">ID</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7">Court</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7">Case ID</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7">Hearing Date</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7">Time</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7">Nature</th>
                                            <th class="text-center text-uppercase text-secondary text-xs opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($hearings as $hearing)
                                            <tr>
                                                <td class="text-center px-3"><p class="text-sm mb-0">{{ $hearing->id }}</p></td>
                                                <td><p class="text-sm mb-0">{{ $hearing->court->name ?? '—' }}</p></td>
                                                <td><p class="text-sm mb-0">{{ $hearing->case_management_id }}</p></td>
                                                <td><p class="text-sm mb-0">{{ \Carbon\Carbon::parse($hearing->hearing_date)->format('d M Y') }}</p></td>
                                                <td><p class="text-sm mb-0">{{ \Carbon\Carbon::parse($hearing->hearing_time)->format('h:i A') }}</p></td>
                                                <td><p class="text-sm mb-0">{{ $hearing->nature_of_court_date ?? '—' }}</p></td>
                                                <td class="text-center align-middle">
                                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                                        <a href="{{ route('company.case-hearings.edit', $hearing->id) }}"
                                                            class="text-secondary text-sm" data-bs-toggle="tooltip" title="Edit">
                                                            <img src="{{ asset('assets/svg/edit-16.svg') }}" alt="edit">
                                                        </a>

                                                        <div class="dropdown">
                                                            <a href="#" class="text-secondary text-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <img src="{{ asset('assets/svg/vertical-dots-16.svg') }}" alt="more">
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="{{ route('company.case-hearings.show', $hearing->id) }}" class="dropdown-item">
                                                                        <i class="bi bi-eye me-1"></i> Show Detail
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <form action="{{ route('company.case-hearings.destroy', $hearing->id) }}" method="POST"
                                                                        onsubmit="return confirm('Are you sure you want to delete this hearing?');">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item text-danger">
                                                                            <i class="bi bi-trash me-1"></i> Delete
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No hearings found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 mx-4">
                            {{ $hearings->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Search Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('hearingSearch');
            searchInput.addEventListener('input', function () {
                const searchValue = this.value.toLowerCase();
                const rows = document.querySelectorAll('#hearingTableWrapper tbody tr');

                rows.forEach(row => {
                    const courtName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const caseId = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    if (courtName.includes(searchValue) || caseId.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</x-app-layout>
