<x-app-layout>

    <x-navbar />


    <div class="container-fluid py-4">

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
        @if ($errors->any())
        <div class="alert alert-danger mx-1">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li class="text-sm text-white">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="row">
            <div class="col-12">
                <h4 class="text-black pb-3 px-3 text-black">Resolve Conflict</h4>
            </div>
        </div>

        <div class="row">
            <!-- Case Hearing 1 -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="m-0 fs-5 text-black">
                            <strong>Client Name:</strong> {{ $caseHearing1->case->client->name ?? 'N/A' }}
                        </h6>
                        <br>
                        <h6 class="m-0 fs-5 text-black">
                            <strong>Case Number:</strong> {{ $caseHearing1->case->case_number ?? 'N/A' }}
                        </h6>
                    </div>


                    <form action="{{ route('company.resolve_logs.update', $caseHearing1->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body pb-3">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-calendar3 me-1"></i> Hearing Date</label>
                                    <input type="date" class="form-control" name="hearing_date"
                                        value="{{ old('hearing_date', $caseHearing1->hearing_date) }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-clock me-1"></i> Hearing Time</label>
                                    <input type="time" class="form-control" name="hearing_time"
                                        value="{{ old('hearing_time', $caseHearing1->hearing_time) }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-file-earmark-text me-1"></i> Nature of the
                                        Court Date</label>
                                    <select name="nature_of_court_date" class="form-control">
                                        <option value="">Select…</option>
                                        @foreach($courts as $court)
                                        <option value="{{ $court->nature_of_court_date }}"
                                            {{ old('nature_of_court_date', $caseHearing1->nature_of_court_date) == $court->nature_of_court_date ? 'selected' : '' }}>
                                            {{ $court->nature_of_court_date }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-bank me-1"></i> Court</label>
                                    <select name="court_id" class="form-control">
                                        <option value="">Select…</option>
                                        @foreach($courts as $court)
                                        <option value="{{ $court->id }}"
                                            {{ old('court_id', $caseHearing1->court_id) == $court->id ? 'selected' : '' }}>
                                            {{ $court->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer pt-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm bg-dark-blue btn-rounded mb-0 text-white"
                                style="width: 116px; height: 44px; font-size: 15px;">
                                save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Case Hearing 2 -->
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header pb-0">
                        <h6 class="m-0 fs-5 text-black">
                            <strong>Client Name:</strong> {{ $caseHearing2->case->client->name ?? 'N/A' }}
                        </h6>
                        <br>
                        <h6 class="m-0 fs-5 text-black">
                            <strong>Case Number:</strong> {{ $caseHearing2->case->case_number ?? 'N/A' }}
                        </h6>
                    </div>

                    <form action="{{ route('company.resolve_logs.update', $caseHearing2->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body pb-3">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-calendar3 me-1"></i> Hearing Date</label>
                                    <input type="date" class="form-control" name="hearing_date"
                                        value="{{ old('hearing_date', $caseHearing2->hearing_date) }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-clock me-1"></i> Hearing Time</label>
                                    <input type="time" class="form-control" name="hearing_time"
                                        value="{{ old('hearing_time', $caseHearing2->hearing_time) }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-file-earmark-text me-1"></i> Nature of the
                                        Court Date</label>
                                    <select name="nature_of_court_date" class="form-control">
                                        <option value="">Select…</option>
                                        @foreach($courts as $court)
                                        <option value="{{ $court->nature_of_court_date }}"
                                            {{ old('nature_of_court_date', $caseHearing2->nature_of_court_date) == $court->nature_of_court_date ? 'selected' : '' }}>
                                            {{ $court->nature_of_court_date }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-bank me-1"></i> Court</label>
                                    <select name="court_id" class="form-control">
                                        <option value="">Select…</option>
                                        @foreach($courts as $court)
                                        <option value="{{ $court->id }}"
                                            {{ old('court_id', $caseHearing2->court_id) == $court->id ? 'selected' : '' }}>
                                            {{ $court->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer pt-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm bg-dark-blue btn-rounded mb-0 text-white"
                                style="width: 116px; height: 44px; font-size: 15px;">
                                save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>