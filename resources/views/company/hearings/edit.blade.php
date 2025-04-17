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