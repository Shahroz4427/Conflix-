<x-app-layout>

    <x-navbar />

    <div class="container-fluid mt-3">
        <div id='calendar'></div>
    </div>

    @push('script')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'today,dayGridMonth,dayGridWeek'
            },
            events: @json($hearings),

            eventContent: function(info) {
                var hearingDetails = `
                    <div>
                        <strong>Case Number:</strong> ${info.event.extendedProps.case_number || 'Unknown'}<br>
                        <strong>Client:</strong> ${info.event.extendedProps.client_name || 'Unknown Client'}<br>
                        <strong>Time:</strong> ${info.event.extendedProps.hearing_time || 'Not Specified'}
                    </div>
                `;
                return { html: hearingDetails };
            },

            eventClassNames: function(info) {
                return info.event.extendedProps.case_number ? 'case-event' : 'default-event';
            },

            eventClick: function(info) {
                var url = info.event.url;
                if (url) {
                    window.location.href = url;
                    return false;
                }
            }
        });

        // Render the calendar and activate the "Today" button
        calendar.render();
        calendar.today();
    });
    </script>
    @endpush
</x-app-layout>
