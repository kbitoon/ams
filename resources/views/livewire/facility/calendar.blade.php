<div id="calendar" class="w-full h-full"></div>
<script>
     $(document).ready(function() {
        var facilitySchedules = @json($facilitySchedules);

        $('#calendar').fullCalendar({
            events: facilitySchedules.map(function(event) {
                return {
                    name: event.name,
                    purpose: event.purpose,
                    start: event.start,
                    end: event.end,
                    location: event.location,
                    facility: event.facility,
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
                    `Purpose: ${event.purpose || 'N/A'}\n` +
                    `Facility: ${event.facility || 'N/A'}\n` +
                    `Location: ${event.location || 'N/A'}\n` +
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
