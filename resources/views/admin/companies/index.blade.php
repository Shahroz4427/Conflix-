<x-app-layout :routePrefix="auth()->user()->user_type=='admin' ? 'admin' : 'company'" navBarAddBtn="Add Company" navBarAddBtnUrl="{{ route('admin.companies.create') }}">

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
                        <h4 class="text-black fs-5 mb-0">Companies</h4>
                    </div>
                    <div class="col-12 px-0">
                        <div class="d-flex pt-3">
                            <a href="{{ route('admin.companies.create') }}"
                                class="w-50 mx-1 btn btn-sm btn-white d-sm-none d-block d-flex justify-content-center align-items-center text-center ps-2 pe-2 mb-0"
                                style="--bs-btn-font-size: 0.78rem;">
                                <span class="d-inline-block me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                        width="20px" fill="#000000">
                                        <path
                                            d="M440-440H240q-17 0-28.5-11.5T200-480q0-17 11.5-28.5T240-520h200v-200q0-17 11.5-28.5T480-760q17 0 28.5 11.5T520-720v200h200q17 0 28.5 11.5T760-480q0 17-11.5 28.5T720-440H520v200q0 17-11.5 28.5T480-200q-17 0-28.5-11.5T440-240v-200Z" />
                                    </svg>
                                </span>
                                Add Company
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-center shadow-lg bg-white rounded-3 mx-1 py-3 my-3">
            <div class="col-md-4 col-12 py-2 pe-0">
                <div class="d-flex align-items-center">
                    <div class="input-group me-2">
                        <span class="input-group-text text-body">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#8392AB">
                                <path
                                    d="M380-320q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l224 224q11 11 11 28t-11 28q-11 11-28 11t-28-11L532-372q-30 24-69 38t-83 14Zm0-80q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                            </svg>
                        </span>
                        <input type="text" id="companySearch" class="form-control bg-transparent"
                            placeholder="Search companies...">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div id="companyTableWrapper">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-center text-xs opacity-7 px-3">
                                                Id
                                            </th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Name</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Email</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Status</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">No. of
                                                Clients
                                            </th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Conflict
                                                Sent
                                            </th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Plan</th>
                                            <th class="text-center text-uppercase text-secondary text-xs opacity-7">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($companies as $company)
                                        <tr>
                                            <td class="text-center px-3">
                                                <p class="text-sm mb-0">{{ $company->id }}</p>
                                            </td>
                                            <td>
                                                <a href="#" class="text-sm mb-0 text-black">{{ $company->user->name }}</a>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $company->user->email }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $company->status }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $company->total_clients }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $company->total_conflict_sent }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $company->subscriptionPlan->plan?? 'N/A' }}
                                                </p>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    {{-- Edit Icon --}}
                                                    <a href="{{ route('admin.companies.edit', $company->id) }}"
                                                        class="text-secondary text-sm" data-bs-toggle="tooltip"
                                                        title="Edit">
                                                        <img src="{{ asset('assets/svg/edit-16.svg') }}" alt="edit">
                                                    </a>

                                                    {{-- Dropdown Menu --}}
                                                    <div class="dropdown">
                                                        <a href="#" class="text-secondary text-sm"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <img src="{{ asset('assets/svg/vertical-dots-16.svg') }}"
                                                                alt="more">
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a href="{{ route('admin.companies.show', $company->id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="bi bi-eye me-1"></i> Show Detail
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('admin.companies.deactivate',$company->id) }}" method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to deactivate this company?');">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                        class="dropdown-item text-danger">
                                                                        <i class="bi bi-x-circle me-1"></i> Deactivate
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
                                            <td colspan="7" class="text-center">No companies found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end mt-4 mx-4">
                            {{ $companies->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('companySearch');

        searchInput.addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#companyTableWrapper tbody tr');

            rows.forEach(row => {
                const companyName = row.querySelector('td:nth-child(2)').textContent
                    .toLowerCase();
                const companyEmail = row.querySelector('td:nth-child(3)').textContent
                    .toLowerCase();

                if (companyName.includes(searchValue) || companyEmail.includes(searchValue)) {
                    row.style.display = ''; 
                } else {
                    row.style.display = 'none'; 
                }
            });
        });
    });
    </script>


</x-app-layout>