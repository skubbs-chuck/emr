$(document).ready(function() {
    $('#calendar').fullCalendar({
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
});