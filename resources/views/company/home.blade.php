<x-app-layout>

    <x-navbar />

    <div class="container-fluid py-4">
        <div class="container py-4">
            <h2 class="fw-bold mb-4">Hello, {{ Auth::user()->name }}</h2>

            <div class="row g-4 mb-4">
                <!-- No. of Clients -->
                <div class="col-md-6">
                    <div class="bg-light rounded shadow-sm p-3">
                        <div class="small fw-semibold text-muted">Total No. of Clients</div>
                        <div class="display-6 fw-bold">{{ $clients ?? 0 }}</div>
                    </div>
                </div>

                <!-- No. of Lawyers -->
                <div class="col-md-6">
                    <div class="bg-light rounded shadow-sm p-3">
                        <div class="small fw-semibold text-muted">Total No. Of Lawyers</div>
                        <div class="display-6 fw-bold">{{ $lawyers ?? 0 }}</div>
                    </div>
                </div>


            </div>
            <div class="row g-4">
                <!-- No. of Cases -->
                <div class="col-md-6">
                    <div class="bg-light rounded shadow-sm p-3">
                        <div class="small fw-semibold text-muted">Total No. Of Cases</div>
                        <div class="display-6 fw-bold">{{ $cases ?? 0 }}</div>
                    </div>
                </div>

                <!-- No. of Conflicts -->
                <div class="col-md-6">
                    <div class="bg-light rounded shadow-sm p-3">
                        <div class="small fw-semibold text-muted">Total No. of Conflicts</div>
                        <div class="display-6 fw-bold">{{ $conflicts ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>