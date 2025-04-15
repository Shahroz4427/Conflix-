<x-app-layout :routePrefix="auth()->user()->user_type=='admin' ? 'admin' : 'company'">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h4 class="text-black pb-3 px-3 text-black">Companies</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="m-0 fs-5 text-black">Create</h6>
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
                    <form action="{{ route('admin.companies.store') }}" method="POST">
                        @csrf
                        <div class="card-body pb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Company Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control mb-3"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control mb-3" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Status</label>
                                    <select name="status" class="form-select text-black mb-3" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Subscription Plan</label>
                                    <select name="company_subscription_plans_id" class="form-select text-black mb-3"
                                        required>
                                        <option value="">Select...</option>
                                        @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}"
                                            {{ old('company_subscription_plans_id') == $plan->id ? 'selected' : '' }}>
                                            {{ $plan->plan }} - ${{ $plan->charges }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-sm text-black">Password</label>
                                    <input type="password" name="password" class="form-control mb-3" required>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer pt-0 text-left d-flex justify-content-end">
                            <div class="text-center me-2">
                                <a href="{{ route('admin.companies.index') }}"
                                    class="btn btn-sm btn-rounded mb-0 bg-white p-0 d-flex justify-content-center align-items-center"
                                    style="width: 116px; height: 44px; border: 2px solid #012568; color: #012568; font-size: 15px;">
                                    Back
                                </a>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-sm bg-dark-blue btn-rounded mb-0 text-white p-0 d-flex justify-content-center align-items-center"
                                    style="width: 116px; height: 44px; font-size: 15px;">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>