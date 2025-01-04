<div id="calendar" class="w-full h-full"></div>
<script>
     $(document).ready(function() {
        var vehicleSchedules = @json($vehicleSchedules);

        $('#calendar').fullCalendar({
            events: vehicleSchedules.map(function(event) {
                return {
                    name: event.name,
                    title: event.title,
                    start: event.start,
                    end: event.end,
                    vehicle: event.vehicle,
                    driver: event.driver,
                    contact_number: event.contact_number,
                    backgroundColor: event.calendar_color,
                    borderColor: event.calendar_color,
                };
            }),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,list'
            },
            eventLimit: 5,
            firstDay: 1,

            eventClick: function (event) {
                var startDate = new Date(event.start);
                var endDate = event.end ? new Date(event.end) : null;

                function formatUTCDate(date) {
                    var hours = date.getUTCHours();
                    var minutes = date.getUTCMinutes();
                    var ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12;
                    minutes = minutes < 10 ? '0' + minutes : minutes;
                    return hours + ':' + minutes + ' ' + ampm;
                }

                var formattedStart = (startDate.getUTCMonth() + 1) + '/' + startDate.getUTCDate() + '/' + startDate.getUTCFullYear() + ' ' + formatUTCDate(startDate);
                var formattedEnd = endDate ? (endDate.getUTCMonth() + 1) + '/' + endDate.getUTCDate() + '/' + endDate.getUTCFullYear() + ' ' + formatUTCDate(endDate) : 'N/A';

                var details =
                    `Name: ${event.name || 'N/A'}\n` +
                    `Destination: ${event.title || 'N/A'}\n` +
                    `Vehicle: ${event.vehicle || 'N/A'}\n` +
                    `Driver: ${event.driver || 'N/A'}\n` +
                    `Driver's Contact #: ${event.contact_number || 'N/A'}\n` +
                    `Schedule Start: ${formattedStart}\n` +
                    `Schedule End: ${formattedEnd}`;

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
