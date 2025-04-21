<x-app-layout>
  
    <x-navbar />

    <div class="container-fluid py-4">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <h4 class="text-black pb-3 px-3 text-black">{{ $client->name }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="m-0 fs-5 text-black">Edit</h6>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                    <div class="alert alert-danger mx-4 mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li class="text-sm text-white">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('company.case_hearing.update', $caseHearing->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body pb-3">
                            <div class="row g-3">

                                <!-- Hearing Date -->
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-calendar3 me-1"></i> Hearing Date
                                    </label>
                                    <input type="date" class="form-control" name="hearing_date"
                                        value="{{ old('hearing_date', $caseHearing->hearing_date) }}">
                                </div>

                                <!-- Hearing Time -->
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-clock me-1"></i> Hearing Time
                                    </label>
                                    <input type="time" class="form-control" name="hearing_time"
                                        value="{{ old('hearing_time', $caseHearing->hearing_time) }}">
                                </div>

                                <!-- Nature -->
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-file-earmark-text me-1"></i> Nature of the Court Date
                                    </label>
                                    <select name="nature_of_court_date" class="form-control">
                                        <option value="">Select…</option>
                                        @foreach($courts as $court)
                                        <option value="{{ $court->nature_of_court_date }}"
                                            {{ old('nature_of_court_date', $caseHearing->nature_of_court_date) == $court->nature_of_court_date ? 'selected' : '' }}>
                                            {{ $court->nature_of_court_date }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Court -->
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-bank me-1"></i> Court
                                    </label>
                                    <select name="court_id" class="form-control">
                                        <option value="">Autofilled or Select…</option>
                                        @foreach($courts as $court)
                                        <option value="{{ $court->id }}"
                                            {{ old('court_id', $caseHearing->court_id) == $court->id ? 'selected' : '' }}>
                                            {{ $court->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pt-0 text-left d-flex justify-content-end">
                            <div class="text-center me-2">
                                <a href="{{ route('company.calendar.index') }}"
                                    class="btn btn-sm btn-rounded mb-0 bg-white p-0 d-flex justify-content-center align-items-center"
                                    style="width: 116px; height: 44px; border: 2px solid #012568; color: #012568; font-size: 15px;">
                                    Back
                                </a>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-sm bg-dark-blue btn-rounded mb-0 text-white p-0 d-flex justify-content-center align-items-center"
                                    style="width: 116px; height: 44px; font-size: 15px;">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>