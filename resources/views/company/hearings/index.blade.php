<x-app-layout>
    <!-- Add Hearing Modal -->
    <div class="modal fade" id="addHearingModal" tabindex="-1" aria-labelledby="addHearingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('company.case_hearing.store') }}">
                    @csrf
                    <input type="hidden" name="form_type" value="add">
                    <input type="hidden" name="case_management_id" value="{{$case->id}}">
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


    @include('company.hearings.partials.nav')


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
                                            <th class="text-uppercase text-secondary text-xs text-center px-3 py-2">ID
                                            </th>
                                            <th class="text-uppercase text-secondary text-xs text-center ps-2 py-2">
                                                Court</th>
                                            <th class="text-uppercase text-secondary text-xs text-center ps-2 py-2">Case
                                                ID</th>
                                            <th class="text-uppercase text-secondary text-xs text-center ps-2 py-2">
                                                Hearing Date</th>
                                            <th class="text-uppercase text-secondary text-xs text-center ps-2 py-2">Time
                                            </th>
                                            <th class="text-uppercase text-secondary text-xs text-center ps-2 py-2">
                                                Nature Of Court</th>
                                            <th class="text-uppercase text-secondary text-xs text-center py-2">Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($hearings as $hearing)
                                        <tr>
                                            <td class="text-center px-3 py-2">
                                                <p class="text-sm mb-0">{{ $hearing->id }}</p>
                                            </td>
                                            <td class="text-center py-2">
                                                <p class="text-sm mb-0">{{ $hearing->court->name ?? '—' }}</p>
                                            </td>
                                            <td class="text-center py-2">
                                                <p class="text-sm mb-0">{{ $hearing->case_management_id }}</p>
                                            </td>
                                            <td class="text-center py-2">
                                                <p class="text-sm mb-0">
                                                    {{ \Carbon\Carbon::parse($hearing->hearing_date)->format('d M Y') }}
                                                </p>
                                            </td>
                                            <td class="text-center py-2">
                                                <p class="text-sm mb-0">
                                                    {{ \Carbon\Carbon::parse($hearing->hearing_time)->format('h:i A') }}
                                                </p>
                                            </td>
                                            <td class="text-center py-2">
                                                <p class="text-sm mb-0">{{ $hearing->nature_of_court_date ?? '—' }}</p>
                                            </td>
                                            <td class="text-center py-2 align-middle">
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
                                            <td colspan="7" class="text-center py-2">No hearings found.</td>
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

    @push('script')

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editNatureSelect = document.getElementById('editNatureSelect');
            const editCourtSelect = document.getElementById('editCourtSelect');

            if (editNatureSelect && editCourtSelect) {
                editNatureSelect.addEventListener('change', function() {
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
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.editHearingBtn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const date = this.dataset.date;
                    const time = this.dataset.time;
                    const nature = this.dataset.nature;
                    const court = this.dataset.court;
                    const actionUrl = this.dataset.action;
                    document.getElementById('editHearingDate').value = date;
                    document.getElementById('editHearingTime').value = time;
                    document.getElementById('editNatureSelect').value = nature;
                    document.getElementById('editCourtSelect').value = court;
                    document.getElementById('editHearingForm').action = actionUrl;
                    const editModal = new bootstrap.Modal(document.getElementById(
                        'editHearingModal'));
                    editModal.show();
                });
            });
        });
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

        document.addEventListener('DOMContentLoaded', function() {
            const natureSelect = document.getElementById('natureSelect');
            const courtSelect = document.getElementById('courtSelect');

            natureSelect.addEventListener('change', function() {
                const selectedNature = this.value;
                for (let option of courtSelect.options) {
                    if (option.dataset.nature === selectedNature) {
                        courtSelect.value = option.value;
                        return;
                    }
                }
                courtSelect.value = "";
            });
        });
    </script>
    @endpush
</x-app-layout>