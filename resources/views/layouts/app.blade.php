<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>Conflix</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/dropzone.css') }}">
    <style>
    /* body scrollbar */
    body::-webkit-scrollbar {
        width: 10px !important;
        /* Adjust the height of the scrollbar */
    }

    body::-webkit-scrollbar-thumb {
        background-color: #012568;
        /* Color of the scrollbar thumb */
        border-radius: 10px;
        /* Rounded corners for the scrollbar thumb */
    }

    body::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        margin-inline: 14px !important;
        border-radius: 10px;
    }

    /* table scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 10px !important;
        /* Adjust the height of the scrollbar */
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background-color: #C1C1C1;
        /* Color of the scrollbar thumb */
        border-radius: 10px;
        /* Rounded corners for the scrollbar thumb */
    }

    .table-responsive::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        margin-inline: 14px !important;
        border-radius: 10px;
    }

    /* offcanvas scrollbar */
    .offcanvas-body::-webkit-scrollbar {
        width: 10px !important;
        /* Adjust the height of the scrollbar */
    }

    .offcanvas-body::-webkit-scrollbar-thumb {
        background-color: #C1C1C1;
        /* Color of the scrollbar thumb */
        border-radius: 10px;
        /* Rounded corners for the scrollbar thumb */
    }

    .offcanvas-body::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        margin-inline: 14px !important;
        border-radius: 10px;
    }

    .offcanvas-header {
        height: 100px !important;
        /* Adjust the height as needed */
    }

    /* dropzone */
    .dropzone.dz-clickable {
        border-width: 1px;
        border-color: black;
    }

    .dropzone.dz-clickable .dz-default.dz-message {
        color: black;
    }

    /* @media (min-width: 1200px) {
            nav.navbar{
                margin-left: calc(15.625rem + 1.5rem) !important;
            }
            } */

    main {
        margin-top: 76px !important;
    }

    .navbar-vertical .navbar-nav .nav-link.active {
        width: 94% !important;
    }

    .modal-backdrop.show {
        z-index: 99999 !important;
        /* Default Bootstrap modal is 1050 */
    }

    .modal {
        z-index: 999999 !important;
    }

    /* Optional: make sure dropdowns/tooltips/popovers don't overlap modals */
    .dropdown-menu,
    .popover,
    .tooltip {
        z-index: 1040 !important;
    }

    .conflict-card {
        border-left: 4px solid #012568;
        margin-bottom: 1.5rem;
    }

    .nav-tabs .nav-link.active {
        font-weight: bold;
        border-bottom: 3px solid #012568;
    }

    .record-card {
        background-color: #f8f9fa;
        border-radius: 0.25rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .allow-dropdown-overflow {
        position: relative;
        overflow: visible !important;
        z-index: 10;
    }

    .table-responsive {
        overflow: visible !important;
        position: relative;
        z-index: 1;
    }

    .table-responsive .dropdown-menu {
        z-index: 1055;
        /* Bootstrap modal level */
        position: absolute !important;
        will-change: transform;
    }
    </style>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
</head>

<body class="g-sidenav-show bg-gray-100">
    <x-sidebar :routePrefix="auth()->user()->user_type === 'admin' ? 'admin' : 'company'" />

    <main class="main-content position-relative border-radius-lg ">
        {{ $slot }}
    </main>
    <script>
    let dropdowns = document.getElementsByClassName('dropdown');

    Array.from(dropdowns).forEach(dropdown => {
        dropdown.addEventListener('click', function() {
            let dropdownMenu = this.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.toggle('d-none');
            }
        });
    });
    </script>
    <script>
    document.getElementById("navbarDropdown").addEventListener("click", function() {
        document.querySelector(".dropdown-menu").classList.toggle("d-none");
    });
    </script>

    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>
    <script>
    // Initialize Bootstrap tabs
    var tabElms = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabElms.forEach(function(tabElm) {
        tabElm.addEventListener('click', function(event) {
            event.preventDefault();
            var tab = new bootstrap.Tab(tabElm);
            tab.show();
        });
    });
    </script>
</body>

</html>