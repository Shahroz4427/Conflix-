<x-app-layout>
    
    @push('style')
    <style>
    .disabled-input {
        background-color: #f5f5f5;
        color: #6c757d;
        border-color: #ddd;
        pointer-events: none;
    }
    </style>
    @endpush
   
    <x-navbar />

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h4 class="text-black pb-3 px-3">Case Management</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="m-0 fs-5 text-black">Create Case</h6>
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

                    <form action="{{ route('company.case_management.store') }}" method="POST">
                        @csrf
                        <div class="card-body pb-3">
                            {{-- Select Client --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Select Client</label>
                                    <select name="client_id" class="form-control mb-3" id="client-select" required>
                                        <option value="">Select...</option>
                                        @foreach($clients as $client)
                                        <option value="{{ $client->id }}" data-email="{{ $client->email }}"
                                            data-address="{{ $client->address }}">
                                            {{ $client->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-sm text-black">Client Email</label>
                                    <input type="email" class="form-control mb-3 disabled-input" name="client_email"
                                        id="client-email" readonly>
                                </div>

                            </div>

                            {{-- Client Address --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-sm text-black">Address</label>
                                    <input type="text" class="form-control mb-3 disabled-input" name="client_address"
                                        id="client-address" readonly>
                                </div>
                            </div>

                            {{-- Select Lawyer --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Select Lawyer</label>
                                    <select name="lawyer_id" class="form-control mb-3" id="lawyer-select" required>
                                        <option value="">Select...</option>
                                        @foreach($lawyers as $lawyer)
                                        <option value="{{ $lawyer->id }}" data-email="{{ $lawyer->email }}">
                                            {{ $lawyer->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-sm text-black">Lawyer Email</label>
                                    <input type="email" class="form-control mb-3 disabled-input" name="lawyer_email"
                                        id="lawyer-email" readonly>
                                </div>
                            </div>

                            {{-- Incarcerated + Case Number --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-sm text-black d-block mb-1">Incarcerated</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="incarcerated" value="1"
                                            checked>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="incarcerated" value="0">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Case Number</label>
                                    <input type="text" name="case_number" class="form-control mb-3">
                                </div>
                            </div>

                            {{-- Dates --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Date of Arrest</label>
                                    <input type="date" name="date_of_arrest" class="form-control mb-3">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Date of Indictment</label>
                                    <input type="date" name="date_of_indictment" class="form-control mb-3">
                                </div>
                            </div>

                            {{-- Judge, County, Court, Filing Date --}}
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-sm text-black">Judge</label>
                                    <input type="text" name="judge" class="form-control mb-3">
                                </div>
                                <div class="col-md-3">
                                    <label class="text-sm text-black">County</label>
                                    <input type="text" name="country" class="form-control mb-3">
                                </div>
                                <div class="col-md-3">
                                    <label class="text-sm text-black">Court</label>
                                    <select name="court_id" class="form-control mb-3">
                                        <option value="">Select…</option>
                                        @foreach($courts as $court)
                                        <option value="{{ $court->id }}">{{ $court->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="text-sm text-black">Filing Date</label>
                                    <input type="date" name="filling_date" class="form-control mb-3">
                                </div>
                            </div>

                            {{-- Calendar Clerk --}}
                            <h6 class="mt-3">Calendar Clerk</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Name</label>
                                    <input type="text" name="calendar_clerk_name" class="form-control mb-3">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Email</label>
                                    <input type="email" name="calendar_clerk_email" class="form-control mb-3">
                                </div>
                            </div>

                            {{-- Opposing Counsel --}}
                            <h6 class="mt-3">Opposing Counsel</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Name</label>
                                    <input type="text" name="opposing_counsel_name" class="form-control mb-3">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Email</label>
                                    <input type="email" name="opposing_counsel_email" class="form-control mb-3">
                                </div>
                            </div>

                            {{-- Clerk of Court --}}
                            <h6 class="mt-3">Clerk of Court</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Name</label>
                                    <input type="text" name="clerk_of_court_name" class="form-control mb-3">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Email</label>
                                    <input type="email" name="clerk_of_court_email" class="form-control mb-3">
                                </div>
                            </div>

                            {{-- Court Date --}}
                            <h6 class="mt-3">Court Date</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Expected Time to Resolve</label>
                                    <input type="date" name="court_date_expected_time_to_resolve"
                                        class="form-control mb-3">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer pt-0 text-left d-flex justify-content-end">
                            <div class="text-center me-2">
                                <a href="{{ route('company.case_management.index') }}"
                                    class="btn btn-sm btn-rounded mb-0 bg-white p-0 d-flex justify-content-center align-items-center"
                                    style="width: 116px; height: 44px; border: 2px solid #012568; color: #012568; font-size: 15px;">
                                    Cancel
                                </a>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-sm bg-dark-blue btn-rounded mb-0 text-white p-0 d-flex justify-content-center align-items-center"
                                    style="width: 116px; height: 44px; font-size: 15px;">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script>
    // Auto-fill Client Email and Address
    document.getElementById('client-select').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById('client-email').value = selectedOption.getAttribute('data-email') || '';
        document.getElementById('client-address').value = selectedOption.getAttribute('data-address') || '';
    });

    // Auto-fill Lawyer Email
    document.getElementById('lawyer-select').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById('lawyer-email').value = selectedOption.getAttribute('data-email') || '';
    });
    </script>
    @endpush

</x-app-layout>