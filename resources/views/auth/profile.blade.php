<x-app-layout :routePrefix="auth()->user()->user_type=='admin' ? 'admin' : 'company'">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold mb-3">{{ Auth::user()->name }}</h4>
            </div>
        </div>

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
                        <h5 class="m-0">Profile Information</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required autofocus>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <h6 class="text-muted">Change Password (optional)</h6>

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
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control">
                            </div>

                            <!-- Save Button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
