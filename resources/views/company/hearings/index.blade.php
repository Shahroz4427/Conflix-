<x-app-layout>
    <!-- Add Hearing Modal -->
    <div class="modal fade" id="addHearingModal" tabindex="-1" aria-labelledby="addHearingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('company.case_hearing.store', $case->id) }}">
                    @csrf
                    <input type="hidden" name="form_type" value="add">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addHearingModalLabel">
                            <i class="bi bi-calendar-event me-2"></i> Add Hearing
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @if ($errors->any() && old('form_type') === 'add')
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li class="text-sm text-white">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row g-3">
                            <!-- Hearing Date -->
                            <div class="col-md-6">
                                <label for="hearingDate" class="form-label">
                                    <i class="bi bi-calendar3 me-1"></i> Hearing Date
                                </label>
                                <input type="date" class="form-control" id="hearingDate" name="hearing_date"
                                    value="{{ old('hearing_date') }}">
                            </div>

                            <!-- Hearing Time -->
                            <div class="col-md-6">
                                <label for="hearingTime" class="form-label">
                                    <i class="bi bi-clock me-1"></i> Hearing Time
                                </label>
                                <input type="time" class="form-control" id="hearingTime" name="hearing_time"
                                    value="{{ old('hearing_time') }}">
                            </div>

                            <!-- Nature of the Court Date -->
                            <div class="col-md-6">
                                <label class="text-sm text-black">Nature of the Court Date</label>
                                <select id="natureSelect" name="nature_of_court_date" class="form-control mb-3">
                                    <option value="">Select…</option>
                                    @foreach($courts as $court)
                                    <option value="{{ $court->nature_of_court_date }}"
                                        {{ old('nature_of_court_date') == $court->nature_of_court_date ? 'selected' : '' }}>
                                        {{ $court->nature_of_court_date }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Court -->
                            <div class="col-md-6">
                                <label class="text-sm text-black">Court</label>
                                <select id="courtSelect" name="court_id" class="form-control mb-3">
                                    <option value="">Autofilled or Select…</option>
                                    @foreach($courts as $court)
                                    <option value="{{ $court->id }}" data-nature="{{ $court->nature_of_court_date }}"
                                        {{ old('court_id') == $court->id ? 'selected' : '' }}>
                                        {{ $court->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="text-center me-2">
                            <button type="button"
                                class="btn btn-sm btn-rounded mb-0 bg-white p-0 d-flex justify-content-center align-items-center"
                                data-bs-dismiss="modal"
                                style="width: 116px; height: 44px; border: 2px solid #012568; color: #012568; font-size: 15px;">
                                <i class="bi bi-x-lg me-1"></i> Cancel
                            </button>
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="btn btn-sm bg-dark-blue btn-rounded mb-0 text-white p-0 d-flex justify-content-center align-items-center"
                                style="width: 116px; height: 44px; font-size: 15px;">
                                <i class="bi bi-save2 me-1"></i> Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Hearing Modal -->
    <div class="modal fade" id="editHearingModal" tabindex="-1" aria-labelledby="editHearingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" id="editHearingForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_from_edit" value="1">
                    <input type="hidden" name="form_type" value="edit">

                    <div class="modal-header">
                        <h5 class="modal-title" id="editHearingModalLabel">
                            <i class="bi bi-pencil-square me-2"></i> Edit Hearing
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @if ($errors->any() && old('form_type') === 'edit')
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li class="text-sm text-white">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row g-3">
                            <!-- Hearing Date -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-calendar3 me-1"></i> Hearing Date
                                </label>
                                <input type="date" class="form-control" id="editHearingDate" name="hearing_date"
                                    value="{{ old('hearing_date') }}">
                            </div>

                            <!-- Hearing Time -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-clock me-1"></i> Hearing Time
                                </label>
                                <input type="time" class="form-control" id="editHearingTime" name="hearing_time"
                                    value="{{ old('hearing_time') }}">
                            </div>

                            <!-- Nature -->
                            <div class="col-md-6">
                                <label class="text-sm text-black">Nature of the Court Date</label>
                                <select id="editNatureSelect" name="nature_of_court_date" class="form-control mb-3">
                                    <option value="">Select…</option>
                                    @foreach($courts as $court)
                                    <option value="{{ $court->nature_of_court_date }}"
                                        {{ old('nature_of_court_date') == $court->nature_of_court_date ? 'selected' : '' }}>
                                        {{ $court->nature_of_court_date }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Court -->
                            <div class="col-md-6">
                                <label class="text-sm text-black">Court</label>
                                <select id="editCourtSelect" name="court_id" class="form-control mb-3">
                                    <option value="">Autofilled or Select…</option>
                                    @foreach($courts as $court)
                                    <option value="{{ $court->id }}" data-nature="{{ $court->nature_of_court_date }}"
                                        {{ old('court_id') == $court->id ? 'selected' : '' }}>
                                        {{ $court->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="text-center me-2">
                            <button type="button"
                                class="btn btn-sm btn-rounded mb-0 bg-white p-0 d-flex justify-content-center align-items-center"
                                data-bs-dismiss="modal"
                                style="width: 116px; height: 44px; border: 2px solid #012568; color: #012568; font-size: 15px;">
                                <i class="bi bi-x-lg me-1"></i> Cancel
                            </button>
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="btn btn-sm bg-dark-blue btn-rounded mb-0 text-white p-0 d-flex justify-content-center align-items-center"
                                style="width: 116px; height: 44px; font-size: 15px;">
                                <i class="bi bi-save2 me-1"></i> Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand px-0 ps-3 py-0 shadow-none border-radius-xl fixed-top bg-dark-blue rounded-0 py-3"
        id="navbarBlur">
        <div class="container-fluid px-3">
            <div class="collapse navbar-collapse justify-content-end mt-sm-0 me-md-0" id="navbar">
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="#"
                            class="btn btn-sm text-sm btn-white d-sm-block d-none d-flex justify-content-center align-items-center text-center ps-2 mb-0 me-2"
                            data-bs-toggle="modal" data-bs-target="#addHearingModal">
                            <span class="d-inline-block me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#000000">
                                    <path
                                        d="M440-440H240q-17 0-28.5-11.5T200-480q0-17 11.5-28.5T240-520h200v-200q0-17 11.5-28.5T480-760q17 0 28.5 11.5T520-720v200h200q17 0 28.5 11.5T760-480q0 17-11.5 28.5T720-440H520v200q0 17-11.5 28.5T480-200q-17 0-28.5-11.5T440-240v-200Z" />
                                </svg>
                            </span>
                            Add Hearing
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
                        <h4 class="text-black fs-5 mb-0">{{$client->name}}</h4>
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
                            <div class="table-responsive" id="hearingTableWrapper">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xs text-center px-3">ID</th>
                                            <th class="text-uppercase text-secondary text-xs ps-2">Court</th>
                                            <th class="text-uppercase text-secondary text-xs ps-2">Case ID</th>
                                            <th class="text-uppercase text-secondary text-xs ps-2">Hearing Date</th>
                                            <th class="text-uppercase text-secondary text-xs ps-2">Time</th>
                                            <th class="text-uppercase text-secondary text-xs ps-2">Nature</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($hearings as $hearing)
                                        <tr>
                                            <td class="text-center px-3">
                                                <p class="text-sm mb-0">{{ $hearing->id }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $hearing->court->name ?? '—' }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $hearing->case_management_id }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">
                                                    {{ \Carbon\Carbon::parse($hearing->hearing_date)->format('d M Y') }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">
                                                    {{ \Carbon\Carbon::parse($hearing->hearing_time)->format('h:i A') }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ $hearing->nature_of_court_date ?? '—' }}</p>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="javascript:void(0);"
                                                        class="text-secondary text-sm editHearingBtn"
                                                        data-id="{{ $hearing->id }}"
                                                        data-date="{{ $hearing->hearing_date }}"
                                                        data-time="{{ $hearing->hearing_time }}"
                                                        data-nature="{{ $hearing->nature_of_court_date }}"
                                                        data-court="{{ $hearing->court_id }}"
                                                        data-action="{{ route('company.case_hearing.update', $hearing->id) }}"
                                                        data-bs-toggle="tooltip" title="Edit">
                                                        <img src="{{ asset('assets/svg/edit-16.svg') }}" alt="edit">
                                                    </a>
                                                    <form
                                                        action="{{ route('company.case_hearing.destroy', $hearing->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this hearing?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="dropdown-item text-danger p-0 border-0 bg-transparent">
                                                            <img src="{{ asset('assets/svg/bin-icon.webp') }}"
                                                                alt="delete" height="24px" width="24px">
                                                        </button>
                                                    </form>
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const editNatureSelect = document.getElementById('editNatureSelect');
        const editCourtSelect = document.getElementById('editCourtSelect');

        if (editNatureSelect && editCourtSelect) {
            editNatureSelect.addEventListener('change', function () {
                const selectedNature = this.value;

                for (let option of editCourtSelect.options) {
                    if (option.dataset.nature === selectedNature) {
                        editCourtSelect.value = option.value;
                        return;
                    }
                }

                editCourtSelect.value = "";
            });
        }
    });
</script>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editHearingBtn').forEach(button => {
            button.addEventListener('click', function() {
                // Get values from data attributes
                const id = this.dataset.id;
                const date = this.dataset.date;
                const time = this.dataset.time;
                const nature = this.dataset.nature;
                const court = this.dataset.court;
                const actionUrl = this.dataset.action;

                // Populate the form
                document.getElementById('editHearingDate').value = date;
                document.getElementById('editHearingTime').value = time;
                document.getElementById('editNatureSelect').value = nature;
                document.getElementById('editCourtSelect').value = court;

                // Set form action
                document.getElementById('editHearingForm').action = actionUrl;

                // Show the modal
                const editModal = new bootstrap.Modal(document.getElementById(
                    'editHearingModal'));
                editModal.show();
            });
        });
    });
    </script>

    @if ($errors->any())
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(old('form_type') === 'add')
        var addModal = new bootstrap.Modal(document.getElementById('addHearingModal'));
        addModal.show();
        @elseif(old('form_type') === 'edit')
        var editModal = new bootstrap.Modal(document.getElementById('editHearingModal'));
        editModal.show();
        @endif
    });
    </script>
    @endif
    {{-- Search Script --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('hearingSearch');
        searchInput.addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#hearingTableWrapper tbody tr');

            rows.forEach(row => {
                const courtName = row.querySelector('td:nth-child(2)').textContent
                    .toLowerCase();
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const natureSelect = document.getElementById('natureSelect');
        const courtSelect = document.getElementById('courtSelect');

        natureSelect.addEventListener('change', function() {
            const selectedNature = this.value;

            // Loop through court options to find a match
            for (let option of courtSelect.options) {
                if (option.dataset.nature === selectedNature) {
                    courtSelect.value = option.value;
                    return;
                }
            }

            // If no match, reset the court select
            courtSelect.value = "";
        });
    });
    </script>

</x-app-layout>