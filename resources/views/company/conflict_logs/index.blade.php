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

        .modal-content {
            padding: 0;
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        }

        /* Modal title and icon */
        .modal-title i {
            color: #5d78ff;
        }

        /* Option buttons style */
        #case-options .btn-option {
            flex: 1 1 calc(50% - 10px);
            background-color: #f9fafc;
            border: 1px solid #dce1e8;
            border-radius: 0.75rem;
            padding: 12px;
            text-align: center;
            color: #333;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        #case-options .btn-option:hover {
            background-color: #e8ebf0;
            border-color: #c5ccd6;
            color: #212529;
        }

        /* Responsive modal width */
        @media (min-width: 576px) {
            .modal-sm {
                max-width: 500px;
            }
        }

        /* Success overlay */
        .success-message {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1055;
        }

        .message-content {
            background-color: #38a169;
            color: white;
            padding: 20px 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
            animation: fadeIn 0.4s ease-in-out;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .message-content .message-icon svg {
            width: 40px;
            height: 40px;
        }

        .message-heading {
            font-size: 18px;
            font-weight: 600;
        }

        .message-text {
            font-size: 15px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
    @endpush

    <x-navbar />
    
    <div id="success-message" class="success-message d-none">
        <div class="message-content">
            <div class="message-icon">
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
        @if (session('success'))
        <div id="successAlert" class="alert alert-success alert-dismissible fade show text-white" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
        setTimeout(function() {
            var alert = document.getElementById('successAlert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            }
        }, 2000);
        </script>
        @endif
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
                        <button class="btn btn-primary bg-dark-blue btn-sm"
                            onclick="openCaseSelectionModal('{{ $log->id }}', '{{ $log->conflict_case_number_1 }}', '{{ $log->conflict_case_number_2 }}')">
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
                        <button class="btn btn-primary bg-dark-blue btn-sm"
                            onclick="openCaseSelectionModal('{{ $log->id }}', '{{ $log->conflict_case_number_1 }}', '{{ $log->conflict_case_number_2 }}')">
                            Send Now
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Modal for Selecting Case -->
    <div class="modal fade" id="selectCaseModal" tabindex="-1" aria-labelledby="selectCaseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content shadow-sm border-0 rounded-4">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-semibold text-primary-emphasis" id="selectCaseModalLabel">
                        <i class="bi bi-folder2-open me-2"></i>Select Case to Send Letter
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4" style="max-height: 60vh; overflow-y: auto;">
                    <p class="mb-3 text-muted">
                        Please select which case you want to send the conflict letter for:
                    </p>
                    <div id="case-options" class="d-flex flex-wrap gap-2">
                        <!-- Dynamic case buttons will be injected here -->
                    </div>
                </div>
                <div class="modal-footer border-top px-4">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script>
    function openCaseSelectionModal(logId, case1, case2) {
        const optionsContainer = document.getElementById('case-options');
        optionsContainer.innerHTML = `
                <button class="btn btn-option" onclick="sendConflictLetter(${logId}, '${case1}')">Case Number: ${case1}</button>
                <button class="btn btn-option" onclick="sendConflictLetter(${logId}, '${case2}')">Case Number: ${case2}</button>
            `;
        const modal = new bootstrap.Modal(document.getElementById('selectCaseModal'));
        modal.show();
    }

    // function sendConflictLetter(logId, caseNumber) {
    //     console.log(`Sending letter for Log ID: ${logId}, Case: ${caseNumber}`);
    //     const modalEl = document.getElementById('selectCaseModal');
    //     const modal = bootstrap.Modal.getInstance(modalEl);
    //     modal.hide();
    //     showSuccessMessage();
    // }

    // function showSuccessMessage() {
    //     const message = document.getElementById('success-message');
    //     message.classList.remove('d-none');
    //     setTimeout(() => message.classList.add('d-none'), 3000);
    // }
    </script>
    @endpush

</x-app-layout>