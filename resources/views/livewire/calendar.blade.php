<div id="calendar" class="w-full h-full"></div>

<script>
    $(document).ready(function() {
        var activities = @json($activities);

        $('#calendar').fullCalendar({
            events: activities,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,list'
            },
            eventLimit: 5,

            eventClick: function(event) {
                var startDate = new Date(event.start);
                var endDate = event.end ? new Date(event.end) : null;

                // Function to format the time as 12-hour AM/PM in UTC
                function formatUTCDate(date) {
                    var hours = date.getUTCHours();
                    var minutes = date.getUTCMinutes();
                    var ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; // The hour '0' should be '12'
                    minutes = minutes < 10 ? '0' + minutes : minutes;
                    return hours + ':' + minutes + ' ' + ampm;
                }

                // Format start and end dates in UTC without timezone conversion
                var formattedStart = (startDate.getUTCMonth() + 1) + '/' + startDate.getUTCDate() + '/' + startDate.getUTCFullYear() + ' ' + formatUTCDate(startDate);
                var formattedEnd = endDate ? (endDate.getUTCMonth() + 1) + '/' + endDate.getUTCDate() + '/' + endDate.getUTCFullYear() + ' ' + formatUTCDate(endDate) : 'N/A';

                var details = 
                    `Destination: ${event.title || 'N/A'}\n` +
                    `Location: ${event.location || 'N/A'}\n` +
                    `Description: ${event.description || 'N/A'}\n` +
                    `Schedule Start: ${formattedStart}\n` +
                    `Schedule End: ${formattedEnd}` ;

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
