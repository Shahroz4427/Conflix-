<x-app-layout :routePrefix="auth()->user()->user_type=='admin' ? 'admin' : 'company'">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <h4 class="mb-4 text-black">Edit Client</h4>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mx-1">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm text-white">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('company.clients.update', $client->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-sm text-black">Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $client->name) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-sm text-black">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-sm text-black">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $client->phone_number) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-sm text-black">Age</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                    <input type="number" name="age" class="form-control" value="{{ old('age', $client->age) }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-sm text-black">Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                    <input type="text" name="address" class="form-control" value="{{ old('address', $client->address) }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-sm text-black">Additional Information</label>
                                <textarea name="additional_information" rows="4" class="form-control">{{ old('additional_information', $client->additional_information) }}</textarea>
                            </div>
                        </div>

                        <div class="card-footer mt-4 pt-0 d-flex justify-content-end">
                            <div class="text-center me-2">
                                <a href="{{ route('company.clients.index') }}"
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
