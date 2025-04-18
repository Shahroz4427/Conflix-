<x-app-layout>
<nav class="navbar navbar-expand px-0 ps-3 py-0 shadow-none border-radius-xl fixed-top bg-dark-blue rounded-0 py-3"
        id="navbarBlur">
        <div class="container-fluid px-3">
            <div class="collapse navbar-collapse justify-content-end mt-sm-0 me-md-0" id="navbar">
                <ul class="navbar-nav justify-content-end">
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
                    <style>
                        .disabled-input {
                            background-color: #f5f5f5; /* Light gray background to appear disabled */
                            color: #6c757d; /* Gray text color to indicate it's disabled */
                            border-color: #ddd; /* Light border to indicate it's non-editable */
                            pointer-events: none;      /* Prevents interaction */
                        }

                    </style>
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
                                    <input type="email" class="form-control mb-3 disabled-input" name="client_email" id="client-email"
                                        readonly >
                    </div>
                                
                            </div>

                            {{-- Client Address --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-sm text-black">Address</label>
                                    <input type="text" class="form-control mb-3 disabled-input" name="client_address"
                                        id="client-address" readonly >
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
                                    <input type="email" class="form-control mb-3 disabled-input" name="lawyer_email" id="lawyer-email"
                                        readonly >
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
                                    <input type="date" name="court_date_expected_time_to_resolve" class="form-control mb-3">
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
    <script>
        // Auto-fill Client Email and Address
        document.getElementById('client-select').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('client-email').value = selectedOption.getAttribute('data-email') || '';
            document.getElementById('client-address').value = selectedOption.getAttribute('data-address') || '';
        });

        // Auto-fill Lawyer Email
        document.getElementById('lawyer-select').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('lawyer-email').value = selectedOption.getAttribute('data-email') || '';
        });
    </script>

</x-app-layout>