<x-app-layout>
    <x-navbar />
    <div class="container-fluid py-4">
        <div class="container py-4">
            <h2 class="fw-bold mb-4">Hello, {{ Auth::user()->name }}</h2>

            <div class="row g-4">
                <!-- Companies -->
                <div class="col-md-4">
                    <div class="bg-light rounded shadow-sm p-3">
                        <div class="small fw-semibold text-muted">Companies</div>
                        <div class="display-6 fw-bold">{{ $companies ?? 0 }}</div>
                    </div>
                </div>

                <!-- No. of Clients -->
                <div class="col-md-4">
                    <div class="bg-light rounded shadow-sm p-3">
                        <div class="small fw-semibold text-muted">No. of Clients</div>
                        <div class="display-6 fw-bold">{{ $clients ?? 0 }}</div>
                    </div>
                </div>

                <!-- No. of Lawyers -->
                <div class="col-md-4">
                    <div class="bg-light rounded shadow-sm p-3">
                        <div class="small fw-semibold text-muted">No. Of Lawyers</div>
                        <div class="display-6 fw-bold">{{ $lawyers ?? 0 }}</div>
                    </div>
                </div>

                <!-- No. of Conflicts Sent -->
                <div class="col-md-4">
                    <div class="bg-light rounded shadow-sm p-3 position-relative">
                        <div class="d-flex justify-content-between">
                            <div class="small fw-semibold text-muted">No. of Conflicts sent</div>
                            <div class="small text-muted">Last 7 days</div>
                        </div>
                        <div class="display-6 fw-bold">{{ $conflict_sent ?? 0}}</div>
                    </div>
                </div>

                <!-- Active Subscriptions -->
                <div class="col-md-4">
                    <div class="bg-light rounded shadow-sm p-3">
                        <div class="small fw-semibold text-muted">Active Subscriptions</div>
                        <div class="display-6 fw-bold">{{$active_subscription ?? 0}}</div>
                    </div>
                </div>

                <!-- In-Active Subscriptions -->
                <div class="col-md-4">
                    <div class="bg-light rounded shadow-sm p-3">
                        <div class="small fw-semibold text-muted">In-Active Subscriptions</div>
                        <div class="display-6 fw-bold">{{$inactive_subscription ?? 0}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>