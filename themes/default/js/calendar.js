$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,basicWeek,basicMonth'
        },
        events: [
        {
            title  : 'event1',
            start  : '2015-08-09',
            color : '#000'
        },
        {
            title  : 'event0',
            start  : '2015-08-09'
        },
        {
            title  : 'event1',
            start  : '2015-08-09'
        },
        ],
    });

    $('#goToDate').datepicker({
        inline: true, 
        format: 'mm-dd-yyyy'
    }).on('changeDate', function(e) {
        var fcDate = new Date($('#calendar').fullCalendar('getDate')._d);
        var dpDate = new Date(e.date);

        console.log(fcDate.getMonth() == dpDate.getMonth());
        // $('#calendar').fullCalendar('gotoDate', ev.format());
    });

});