<x-app-layout>

    <x-navbar />

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h4 class="text-black pb-3 px-3">Lawyers</h4>
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

                    <form action="{{ route('company.lawyers.store') }}" method="POST">
                        @csrf
                        <div class="card-body pb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-sm text-black">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control mb-3"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-sm text-black">Phone Number</label>
                                    <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                        class="form-control mb-3">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-sm text-black">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control mb-3">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-sm text-black">Address</label>
                                    <input type="text" name="address" value="{{ old('address') }}"
                                        class="form-control mb-3">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-sm text-black">Jurisdiction</label>
                                    <select name="jurisdiction_id" class="form-control mb-3" required>
                                        <option value="" disabled selected>Select Jurisdiction</option>
                                        @foreach ($jurisdictions as $jurisdiction)
                                        <option value="{{ $jurisdiction->id }}"
                                            {{ old('jurisdiction_id') == $jurisdiction->id ? 'selected' : '' }}>
                                            {{ $jurisdiction->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-sm text-black">Additional Information</label>
                                    <textarea name="additional_information" rows="4"
                                        class="form-control mb-3">{{ old('additional_information') }}</textarea>
                                </div>
                            </div>


                        </div>

                        <div class="card-footer pt-0 text-left d-flex justify-content-end">
                            <div class="text-center me-2">
                                <a href="{{ route('company.lawyers.index') }}"
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