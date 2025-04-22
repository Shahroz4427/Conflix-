<x-app-layout :routePrefix="auth()->user()->user_type=='admin' ? 'admin' : 'company'">
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
    <div class="container-fluid p-4">
        <!-- <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold mb-3">{{ Auth::user()->name }}</h4>
            </div>
        </div> -->

        {{-- Display status message if any --}}
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')

<!--                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="form-control" required autofocus>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                           
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-control" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <h6 class="text-muted">Change Password (optional)</h6> -->

                            <!-- Old Password -->
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Current Password</label>
                                <input id="old_password" type="password" name="old_password" class="form-control">
                                @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input id="password" type="password" name="password" class="form-control">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    class="form-control">
                            </div>

                            <!-- Save Button -->
                            <div class="d-flex justify-content-end">
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-sm bg-dark-blue btn-rounded mb-0 text-white p-0 d-flex justify-content-center align-items-center"
                                        style="width: 116px; height: 44px; font-size: 15px;">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>