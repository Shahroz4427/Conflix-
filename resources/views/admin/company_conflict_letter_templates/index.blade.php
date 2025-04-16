<x-app-layout>
    <nav class="navbar navbar-expand px-0 ps-3 py-0 shadow-none border-radius-xl fixed-top bg-dark-blue rounded-0 py-3"
        id="navbarBlur">
        <div class="container-fluid px-3">
            <div class="collapse navbar-collapse justify-content-end mt-sm-0 me-md-0" id="navbar">
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('admin.company_conflict_letter_templates.create') }}"
                            class="btn btn-sm text-sm btn-white d-sm-block d-none d-flex justify-content-center align-items-center text-center ps-2 mb-0 me-2">
                            <span class="d-inline-block me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#000000">
                                    <path
                                        d="M440-440H240q-17 0-28.5-11.5T200-480q0-17 11.5-28.5T240-520h200v-200q0-17 11.5-28.5T480-760q17 0 28.5 11.5T520-720v200h200q17 0 28.5 11.5T760-480q0 17-11.5 28.5T720-440H520v200q0 17-11.5 28.5T480-200q-17 0-28.5-11.5T440-240v-200Z" />
                                </svg>
                            </span>
                            Add Template
                        </a>
                    </li>
                    <li class="nav-item dropdown d-flex align-items-center ps-2">
                        <a href="#" class="nav-link text-white font-weight-bold px-0" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="width: 35px; height: 35px; text-align: center; border: 2px solid #F6F9FC; border-radius: 100%;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="position: relative; margin-top: -13px;"
                                height="24px" viewBox="0 -960 960 960" width="24px" fill="#F8F9FA">
                                <path
                                    d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-240v-32q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v32q0 33-23.5 56.5T720-160H240q-33 0-56.5-23.5T160-240Zm80 0h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end d-none" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-black" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-black"
                                        style="background: none; border: none;">
                                        Logout
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
                        <h4 class="text-black fs-5 mb-0">Conflict Letter Templates</h4>
                    </div>
                    <div class="col-12 px-0">
                        <div class="d-flex pt-3">
                            <a href="{{ route('admin.company_conflict_letter_templates.create') }}"
                                class="w-50 mx-1 btn btn-sm btn-white d-sm-none d-block d-flex justify-content-center align-items-center text-center ps-2 pe-2 mb-0"
                                style="--bs-btn-font-size: 0.78rem;">
                                <span class="d-inline-block me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                        width="20px" fill="#000000">
                                        <path
                                            d="M440-440H240q-17 0-28.5-11.5T200-480q0-17 11.5-28.5T240-520h200v-200q0-17 11.5-28.5T480-760q17 0 28.5 11.5T520-720v200h200q17 0 28.5 11.5T760-480q0 17-11.5 28.5T720-440H520v200q0 17-11.5 28.5T480-200q-17 0-28.5-11.5T440-240v-200Z" />
                                    </svg>
                                </span>
                                Add Template
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
                        <input type="text" id="templateSearch" class="form-control bg-transparent"
                            placeholder="Search templates...">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="table-responsive" id="templateTableWrapper">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-center text-xs opacity-7 px-3">
                                                Id</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Title</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Status</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Uploaded By
                                            </th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Uploaded
                                                Date</th>
                                            <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($letterTemplates as $template)
                                        <tr>
                                            <td class="text-center px-3">
                                                <p class="text-sm mb-0">{{ $template->id }}</p>
                                            </td>
                                            <td>
                                                <a href="#" class="text-sm mb-0 text-black">{{ $template->title }}</a>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $template->status }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $template->uploaded_by }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $template->uploaded_date->format('Y-m-d') }}
                                                </p>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    {{-- Edit Icon --}}
                                                    <a href="{{ route('admin.company_conflict_letter_templates.edit', $template->id) }}"
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
                                                                <a href="{{ route('admin.company_conflict_letter_templates.show', $template->id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="bi bi-eye me-1"></i> Show Detail
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('admin.company_conflict_letter_templates.destroy',$template->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this template?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item text-danger">
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
                                            <td colspan="6" class="text-center">No templates found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4 mx-4">
                            {{ $letterTemplates->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('templateSearch');

        searchInput.addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#templateTableWrapper tbody tr');

            rows.forEach(row => {
                const templateTitle = row.querySelector('td:nth-child(2)').textContent
                    .toLowerCase();
                const uploadedBy = row.querySelector('td:nth-child(4)').textContent
                    .toLowerCase();

                if (templateTitle.includes(searchValue) || uploadedBy.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    </script>

</x-app-layout>