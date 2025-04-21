<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main" style="z-index: 1069;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand text-center m-0" href="#">
            <img src="{{ asset('assets/img/conflix.png') }}" class="navbar-brand-img h-100" style="width: 140px;"
                alt="main_logo">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if ($routePrefix=='admin')
            <li class="nav-item">
                <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->is('admin/home') ? 'active' : '' }}"
                    href="{{ route('admin.home') }}">
                    <div>
                        {{-- Dashboard SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="currentColor">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8v-10h-8v10zm0-18v6h8V3h-8z" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->is('admin/companies*') ? 'active' : '' }}"
                    href="{{ route('admin.companies.index') }}">
                    <div>
                        {{-- Companies SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="currentColor">
                            <path d="M4 4h16v2H4V4zm0 4h16v2H4V8zm0 4h10v2H4v-2zm0 4h10v2H4v-2zm12 0h4v6h-4v-6z" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Companies</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->is('admin/company_conflict_letter_templates*') ? 'active' : '' }}"
                    href="{{ route('admin.company_conflict_letter_templates.index') }}">
                    <div>
                        {{-- Conflict Letter Templates SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="currentColor">
                            <path d="M14 2H6c-1.1 0-2 .9-2 2v16l4-4h6c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" />
                            <path d="M20 6h-2v12h-4v2h6V6z" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Conflict Letter Templates</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->is('profile*') ? 'active' : '' }}"
                    href="{{ route('profile.edit') }}">
                    <div>
                        {{-- Change Password SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="currentColor">
                            <path
                                d="M12 17c1.66 0 3-1.34 3-3v-2h1c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2H8C6.9 5 6 5.9 6 7v3c0 1.1.9 2 2 2h1v2c0 1.66 1.34 3 3 3zM8 7h8v3H8V7z" />
                            <path d="M18 20c1.1 0 2-.9 2-2v-1H4v1c0 1.1.9 2 2 2h12z" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Change Password</span>
                </a>
            </li>

            @endif

            @if ($routePrefix=='company')
            <li class="nav-item mt-1">
                <a class="nav-link d-flex align-items-center {{ request()->is('company/home') ? 'active' : '' }}"
                    href="{{ route('company.home') }}">
                    <div class="me-2">
                        {{-- Dashboard SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8v-10h-8v10zm0-18v6h8V3h-8z" />
                        </svg>
                    </div>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-1">
                <a class="nav-link d-flex align-items-center {{ request()->is('company/case_management*', 'company/case_hearing*') ? 'active' : '' }}"
                    href="{{ route('company.case_management.index') }}">
                    <div class="me-2">
                        {{-- Case Management SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M10 4H2v16h20V6H12l-2-2z" />
                        </svg>
                    </div>
                    <span>Case Managements</span>
                </a>
            </li>

            <li class="nav-item mt-1">
                <a class="nav-link d-flex align-items-center {{ request()->is('company/clients*') ? 'active' : '' }}"
                    href="{{ route('company.clients.index') }}">
                    <div class="me-2">
                        {{-- Clients SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 2.03 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                        </svg>
                    </div>
                    <span>Clients</span>
                </a>
            </li>

            <li class="nav-item mt-1">
                <a class="nav-link d-flex align-items-center {{ request()->is('company/lawyers*') ? 'active' : '' }}"
                    href="{{ route('company.lawyers.index') }}">
                    <div class="me-2">
                        {{-- Lawyers SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 3L2 9l10 6 10-6-10-6zm0 11.3L4.4 9 12 4.7 19.6 9 12 14.3zM12 15v6h-2v2h6v-2h-2v-6h-2z" />
                        </svg>
                    </div>
                    <span>Lawyers</span>
                </a>
            </li>

            <li class="nav-item mt-1">
                <a class="nav-link d-flex align-items-center {{ request()->is('company/calendar*') ? 'active' : '' }}"
                    href="{{ route('company.calendar.index') }}">
                    <div class="me-2">
                        {{-- Calendar SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 
                2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z" />
                        </svg>
                    </div>
                    <span>Calendar</span>
                </a>
            </li>

            <li class="nav-item mt-1">
                <a class="nav-link d-flex align-items-center {{ request()->is('company/conflict_logs*') ? 'active' : '' }}"
                    href="{{ route('company.conflict_logs.index') }}">
                    <div class="me-2">
                        {{-- Conflict Logs SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 
                10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8 
                0-1.85.63-3.55 1.69-4.9l11.21 11.21C15.55 19.37 13.85 20 12 20zm6.31-3.1L7.1 5.69C8.45 4.63 
                10.15 4 12 4c4.41 0 8 3.59 8 8 0 1.85-.63 3.55-1.69 4.9z" />
                        </svg>
                    </div>
                    <span>Conflict Logs</span>
                </a>
            </li>

            <li class="nav-item mt-1">
                <a class="nav-link d-flex align-items-center {{ request()->is('company/profile*') || request()->routeIs('profile.edit') ? 'active' : '' }}"
                    href="{{ route('profile.edit') }}">
                    <div class="me-2">
                        {{-- Settings SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M19.14,12.94c0.04,-0.31 0.06,-0.63 0.06,-0.94c0,-0.32 -0.02,-0.63 -0.06,-0.94l2.03,-1.58c0.18,-0.14 
                0.23,-0.41 0.12,-0.61l-1.92,-3.32c-0.11,-0.2 -0.36,-0.28 -0.57,-0.22l-2.39,0.96c-0.5,-0.38 
                -1.05,-0.7 -1.66,-0.94l-0.36,-2.54c-0.03,-0.22 -0.22,-0.38 -0.44,-0.38h-3.84c-0.22,0 -0.41,0.16 
                -0.44,0.38l-0.36,2.54c-0.61,0.24 -1.16,0.56 -1.66,0.94l-2.39,-0.96c-0.21,-0.08 -0.46,0.02 
                -0.57,0.22l-1.92,3.32c-0.11,0.2 -0.07,0.47 0.12,0.61l2.03,1.58c-0.04,0.31 -0.06,0.63 -0.06,0.94c0,0.32 
                0.02,0.63 0.06,0.94l-2.03,1.58c-0.18,0.14 -0.23,0.41 -0.12,0.61l1.92,3.32c0.11,0.2 0.36,0.28 
                0.57,0.22l2.39,-0.96c0.5,0.38 1.05,0.7 1.66,0.94l0.36,2.54c0.03,0.22 0.22,0.38 0.44,0.38h3.84c0.22,0 
                0.41,-0.16 0.44,-0.38l0.36,-2.54c0.61,-0.24 1.16,-0.56 1.66,-0.94l2.39,0.96c0.21,0.08 0.46,-0.02 
                0.57,-0.22l1.92,-3.32c0.11,-0.2 0.07,-0.47 -0.12,-0.61l-2.03,-1.58zM12,15.5c-1.93,0 -3.5,-1.57 -3.5,-3.5s1.57,-3.5 
                3.5,-3.5 3.5,1.57 3.5,3.5 -1.57,3.5 -3.5,3.5z" />
                        </svg>
                    </div>
                    <span>Settings</span>
                </a>
            </li>

            @endif


        </ul>
    </div>
</aside>