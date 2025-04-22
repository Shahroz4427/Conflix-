<x-app-layout>

    @push('style')
    <style>
        .success-message {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .message-content {
            background-color: #38a169;
            color: white;
            padding: 20px 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
        }

        .message-icon svg {
            width: 40px;
            height: 40px;
            margin-right: 15px;
        }

        .message-text {
            font-size: 16px;
        }

        .message-heading {
            font-size: 18px;
            font-weight: bold;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
    @endpush


    <x-navbar />

    <!-- Sweet Alert Style Success Message -->
    <div id="success-message" class="success-message d-none">
        <div class="message-content">
            <div class="message-icon">
                <!-- Checkmark Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="message-text">
                <p class="message-heading">Success!</p>
                <p>Conflict Letter Sent Successfully</p>
            </div>
        </div>
    </div>

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
                                <strong>{{ $log->formatted_conflict_date_time }}</strong>
                            </p>
                        </div>
                        <div class="text-end small text-muted">
                            <p class="mb-1">Record Generated on: {{ $log->formatted_created_at }}</p>
                            <p class="mb-0">Conflict letter scheduled to send on:
                                {{ $log->formatted_conflict_date_time }}
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('company.resolve_logs.edit', $log->id) }}"
                            class="btn btn-outline-secondary btn-sm">
                            Change Case Details
                        </a>
                        <button onclick="showSuccessMessage()" class="btn btn-primary bg-dark-blue btn-sm">
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
                                <strong>{{ $log->formatted_conflict_date_time }}</strong>
                            </p>
                        </div>
                        <div class="text-end small text-muted">
                            <p class="mb-1">Record Generated on: {{ $log->formatted_created_at }}</p>
                            <p class="mb-0">Conflict letter scheduled to send on:
                                {{ $log->formatted_conflict_date_time }}
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('company.resolve_logs.edit', $log->id) }}"
                            class="btn btn-outline-secondary btn-sm">
                            Change Case Details
                        </a>
                        <button onclick="showSuccessMessage()" class="btn btn-primary bg-dark-blue btn-sm">
                            Send Now
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @push('script')
    <script>
        function showSuccessMessage() {
            const message = document.getElementById('success-message');
            message.classList.remove('d-none');

            setTimeout(() => {
                message.classList.add('d-none');
            }, 3000);
        }
    </script>
    @endpush

</x-app-layout>