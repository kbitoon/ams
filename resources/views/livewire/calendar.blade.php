<div id="calendar" class="w-full h-full"></div>

<script>
    $(document).ready(function() {
        var activities = @json($activities);

        $('#calendar').fullCalendar({
            events: activities,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            }
        });
    });
</script>
