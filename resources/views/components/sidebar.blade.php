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
                <li class="nav-item ">
                    <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->routeIs('admin.home') ? 'active' : '' }}"
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
                    <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->routeIs('admin.companies.index') ? 'active' : '' }}"
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
                    <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->routeIs('admin.company_conflict_letter_templates.index') ? 'active' : '' }}"
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
                    <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
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
                <li class="nav-item ">
                    <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->routeIs('company.home') ? 'active' : '' }}"
                        href="{{ route('company.home') }}">
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
                    <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->routeIs('company.case_management.index') ? 'active' : '' }}"
                        href="{{ route('company.case_management.index') }}">
                        <div>
                            {{-- Case Management--}}
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                                <path d="M10 4H2v16h20V6H12l-2-2z" />
                            </svg>

                        </div>
                        <span class="nav-link-text ms-1">Case Managements</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->routeIs('company.clients.index') ? 'active' : '' }}"
                        href="{{ route('company.clients.index') }}">
                        <div>
                            {{-- Clients SVG --}}
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 2.03 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                            </svg>

                        </div>
                        <span class="nav-link-text ms-1">Clients</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link flex-grow-1 d-flex align-items-center pe-0 me-0 mt-1 {{ request()->routeIs('company.lawyers.index') ? 'active' : '' }}"
                        href="{{ route('company.lawyers.index') }}">
                        <div>
                            {{-- Lawyers SVG --}}
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                                <path d="M12 3L2 9l10 6 10-6-10-6zm0 11.3L4.4 9 12 4.7 19.6 9 12 14.3zM12 15v6h-2v2h6v-2h-2v-6h-2z" />
                            </svg>

                        </div>
                        <span class="nav-link-text ms-1">Lawyers</span>
                    </a>
                </li>
            @endif


        </ul>
    </div>
</aside>