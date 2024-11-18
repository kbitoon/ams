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
        
            dayRender: function(date, cell) {
                var eventCount = cell.find('.fc-event').length;
                if (eventCount > 5) {
                    cell.addClass('has-more-events');
                }
            }
        });
    });
</script>
