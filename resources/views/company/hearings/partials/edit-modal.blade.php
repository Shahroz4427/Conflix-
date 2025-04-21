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
