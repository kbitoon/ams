<div id="calendar" class="w-full h-full"></div>

<script>
    $(document).ready(function() {
        var vehicleSchedules = @json($vehicleSchedules);

        $('#calendar').fullCalendar({
            events: vehicleSchedules,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,list'
            },
            eventLimit: 5,

            eventClick: function(event) {
                var details = `
                    Destination: ${event.title || 'N/A'}\n
                    Vehicle: ${event.vehicle|| 'N/A'}\n
                    Driver: ${event.driver|| 'N/A'}\n
                    Schedule Start: ${event.formatted_start || event.start}\n
                    Schedule End: ${event.formatted_end || event.end || 'N/A'}\n
                `;
                alert(details);
            },

            dayRender: function(date, cell) {
                var eventCount = cell.find('.fc-event').length;
                if (eventCount > 5) {
                    cell.addClass('has-more-events');
                }
            }
        });
    });
</script>
