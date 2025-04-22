<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>Conflix</title>
    <style>
    .fc-state-disabled {
        pointer-events: auto !important;
        opacity: 1 !important;
    }

    .fc .fc-button {
        background-color: #e0e0e0 !important;
        border: none !important;
        color: #333 !important;
        font-weight: bold;
        padding: 6px 12px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .fc .fc-button-active {
        background-color: #004e8e !important;
        color: #fff !important;
    }

    .fc .fc-button:hover {
        background-color: #003b6b !important;
        color: #fff !important;
    }

    .fc .fc-button:focus {
        box-shadow: none !important;
    }

    .fc-today-button,
    .fc-dayGridMonth-button,
    .fc-dayGridWeek-button {
        text-transform: capitalize !important;
    }

    .page-item .page-link,
    .page-item span {
        color: black !important;
    }


    .page-link.active,
    .active>.page-link {
        background-color: #5e72e47a !important;
    }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('style')
</head>

<body class="g-sidenav-show bg-gray-100">

    <x-sidebar :routePrefix="auth()->user()->user_type === 'admin' ? 'admin' : 'company'" />

    <main class="main-content position-relative border-radius-lg ">
        {{ $slot }}
    </main>

    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @stack('script')
</body>

</html>