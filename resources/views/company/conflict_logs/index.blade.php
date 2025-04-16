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
    <div class="container py-4 px-4">
        <h1 class="mb-4 fw-bold     "><i class="bi bi-journal-text me-2"></i>Conflict Logs</h1>

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs nav-fill mb-4 rounded border" id="conflictTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-semibold" id="upcoming-tab" data-bs-toggle="tab"
                    data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming" aria-selected="true">
                    <i class="bi bi-clock-history me-1"></i> Upcoming
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold" id="change-tab" data-bs-toggle="tab" data-bs-target="#change"
                    type="button" role="tab" aria-controls="change" aria-selected="false">
                    <i class="bi bi-clock me-1"></i> History
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="conflictTabsContent">

            <!-- Upcoming Tab -->
            <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-column flex-md-row align-items-start">
                                    <div class="mb-3 mb-md-0">
                                        <p class="mb-2 text-muted"><i class="bi bi-envelope-paper me-1"></i> Conflict
                                            letter will be sent to:
                                            <strong class="text-dark">James Andreson, CN: 73273793</strong>
                                        </p>
                                        <ul class="list-unstyled ps-3 mb-0 small">
                                            <li><i class="bi bi-calendar-event me-1"></i> Record Generated on:
                                                <strong>04 March 2025, 11:15AM</strong></li>
                                            <li><i class="bi bi-calendar-check me-1"></i> Letter scheduled for:
                                                <strong>07 March 2025</strong></li>
                                            <li><i class="bi bi-people me-1"></i> Conflict Between: <strong>CN:
                                                    73273793</strong>, CN: 43243244</li>
                                            <li><i class="bi bi-clock me-1"></i> Conflict Date & Time: <strong>07 April
                                                    2025</strong></li>
                                        </ul>
                                    </div>
                                    <div class="d-flex flex-column flex-md-row gap-2">
                                        <button class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil-square me-1"></i> Change Case Details
                                        </button>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="bi bi-send me-1"></i> Send Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- History Tab -->
            <div class="tab-pane fade" id="change" role="tabpanel" aria-labelledby="change-tab">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-column flex-md-row align-items-start">
                                    <div class="mb-3 mb-md-0">
                                        <p class="mb-2 text-muted"><i class="bi bi-envelope-paper me-1"></i> Conflict
                                            letter was sent to:
                                            <strong class="text-dark">James Andreson, CN: 73273793</strong>
                                        </p>
                                        <ul class="list-unstyled ps-3 mb-0 small">
                                            <li><i class="bi bi-calendar-event me-1"></i> Record Generated on:
                                                <strong>04 March 2025, 11:15AM</strong></li>
                                            <li><i class="bi bi-calendar-check me-1"></i> Letter was sent on: <strong>07
                                                    March 2025</strong></li>
                                            <li><i class="bi bi-people me-1"></i> Conflict Between: <strong>CN:
                                                    73273793</strong>, CN: 43243244</li>
                                            <li><i class="bi bi-clock me-1"></i> Conflict Date & Time: <strong>07 April
                                                    2025</strong></li>
                                        </ul>
                                    </div>
                                    <div class="d-flex flex-column flex-md-row gap-2">
                                        <button class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil-square me-1"></i> Change Case Details
                                        </button>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="bi bi-send me-1"></i> Send Again
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>