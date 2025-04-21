let dropdowns = document.getElementsByClassName('dropdown');

Array.from(dropdowns).forEach(dropdown => {
    dropdown.addEventListener('click', function() {
        let dropdownMenu = this.querySelector('.dropdown-menu');
        if (dropdownMenu) {
            dropdownMenu.classList.toggle('d-none');
        }
    });
});

document.getElementById("navbarDropdown").addEventListener("click", function() {
    document.querySelector(".dropdown-menu").classList.toggle("d-none");
});

var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}

document.querySelectorAll('#conflictTabs .nav-link').forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();
        // Add 'active' only to clicked tab
        this.classList.add('active');

        // Toggle tab content
        const selectedTab = this.getAttribute('data-tab');

        // Show/Hide content divs
        document.getElementById('upcomingTab').classList.toggle('d-none', selectedTab !==
            'upcoming');
        document.getElementById('historyTab').classList.toggle('d-none', selectedTab !== 'history');
    });
});