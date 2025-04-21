<x-app-layout>

    <x-navbar />


    <div class="container-fluid px-4">
        <h4 class="fw-bold mb-4 mt-2">Conflict Logs</h4>

        <!-- Tabs -->
        <ul class="nav nav-pills mb-4" id="conflictTabs">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-tab="upcoming">Upcoming</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-tab="history">History</a>
            </li>
        </ul>

        <!-- Upcoming Logs -->
        <div id="upcomingTab">
            @foreach($upcomingLogs as $log)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <p class="mb-1">Conflict letter will be sent to:
                                <strong>{{ $log->recipient_name }}, CN:{{ $log->recipient_case_number }}</strong>
                            </p>
                            <p class="mb-1 text-muted small">Conflict Between:
                                <strong>CN: {{ $log->conflict_case_number_1 }}</strong> &nbsp;
                                <strong>CN: {{ $log->conflict_case_number_2 }}</strong>
                            </p>
                            <p class="mb-0 text-muted small">Conflict Date & Time:
                                <strong>{{ $log->conflict_date_time }}</strong>
                            </p>
                        </div>
                        <div class="text-end small text-muted">
                            <p class="mb-1">Record Generated on: {{ $log->created_at }}</p>
                            <p class="mb-0">Conflict letter scheduled to send on:
                                {{ $log->conflict_date_time }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('company.resolve_logs.edit', $log->id) }}"
                            class="btn btn-outline-secondary btn-sm">
                            Change Case Details
                        </a>
                        <button onclick="window.location.href='{{ route('company.conflict_letter.send') }}'"
                            class="btn btn-primary bg-dark-blue btn-sm">
                            Send Now
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- History Logs -->
        <div id="historyTab" class="d-none">
            @foreach($historyLogs as $log)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <p class="mb-1">Conflict letter was sent to:
                                <strong>{{ $log->recipient_name }}, CN:{{ $log->recipient_case_number }}</strong>
                            </p>
                            <p class="mb-1 text-muted small">Conflict Between:
                                <strong>CN: {{ $log->conflict_case_number_1 }}</strong> &nbsp;
                                <strong>CN: {{ $log->conflict_case_number_2 }}</strong>
                            </p>
                            <p class="mb-0 text-muted small">Conflict Date & Time:
                                <strong>{{ $log->conflict_date_time }}</strong>
                            </p>
                        </div>
                        <div class="text-end small text-muted">
                            <p class="mb-1">Record Generated on: {{ $log->created_at }}</p>
                            <p class="mb-0">Conflict letter scheduled to send on: {{ $log->conflict_date_time}}
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('company.resolve_logs.edit', $log->id) }}"
                            class="btn btn-outline-secondary btn-sm">
                            Change Case Details
                        </a>
                        <button class="btn btn-primary bg-dark-blue btn-sm"
                            onclick="window.location.href='{{ route('company.conflict_letter.send') }}'">
                            Send Now
                        </button>


                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</x-app-layout>