<x-app-layout>
   
    <x-navbar buttonName="Add Client" buttonUrl="{{ route('company.clients.create') }}"/>


    <div class="container-fluid py-4">
        {{-- Success Message --}}
        @if (session('success'))
        <div id="successAlert" class="alert alert-success alert-dismissible fade show text-white" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            setTimeout(function() {
                var alert = document.getElementById('successAlert');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(function() {
                        alert.style.display = 'none'; 
                    }, 500); 
                }
            }, 2000); 
        </script>
        @endif

        <div class="row mb-2">
            <div class="col-12">
                <div class="row px-3">
                    <div class="col-12">
                        <h4 class="text-black fs-5 mb-0">Clients</h4>
                    </div>
                    <div class="col-12 px-0">
                        <div class="d-flex pt-3">
                            <a href="{{ route('company.clients.create') }}"
                                class="w-50 mx-1 btn btn-sm btn-white d-sm-none d-block d-flex justify-content-center align-items-center text-center ps-2 pe-2 mb-0"
                                style="--bs-btn-font-size: 0.78rem;">
                                <span class="d-inline-block me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                        width="20px" fill="#000000">
                                        <path
                                            d="M440-440H240q-17 0-28.5-11.5T200-480q0-17 11.5-28.5T240-520h200v-200q0-17 11.5-28.5T480-760q17 0 28.5 11.5T520-720v200h200q17 0 28.5 11.5T760-480q0 17-11.5 28.5T720-440H520v200q0 17-11.5 28.5T480-200q-17 0-28.5-11.5T440-240v-200Z" />
                                    </svg>
                                </span>
                                Add Client
                            </a>
                        </div>
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
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#8392AB">
                                <path
                                    d="M380-320q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l224 224q11 11 11 28t-11 28q-11 11-28 11t-28-11L532-372q-30 24-69 38t-83 14Zm0-80q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                            </svg>
                        </span>
                        <input type="text" id="clientSearch" class="form-control bg-transparent"
                            placeholder="Search clients...">
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
                            <div class="table-responsive" id="clientTableWrapper">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-center text-xs opacity-7 px-3">
                                                Id</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Name</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Email</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Phone</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Age</th>


                                            <th class="text-center text-uppercase text-secondary text-xs opacity-7">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($clients as $client)
                                        <tr>
                                            <td class="text-center px-3">
                                                <p class="text-sm mb-0">{{ $client->id }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $client->name }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $client->email ?? '—' }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $client->phone_number ?? '—' }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $client->age ?? '—' }}</p>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    {{-- Edit Icon --}}
                                                    <a href="{{ route('company.clients.edit', $client->id) }}"
                                                        class="text-secondary text-sm" data-bs-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>

                                                    {{-- View Detail Icon --}}
                                                    <a href="{{ route('company.clients.show', $client->id) }}"
                                                        class="text-secondary text-sm" data-bs-toggle="tooltip"
                                                        title="Show Detail">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>

                                                    {{-- Delete Icon --}}
                                                    <form action="{{ route('company.clients.destroy', $client->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this client?');"
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
                                            <td colspan="8" class="text-center">No clients found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 mx-4">
                            {{ $clients->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('clientSearch');
        searchInput.addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#clientTableWrapper tbody tr');

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (name.includes(searchValue) || email.includes(searchValue)) {
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