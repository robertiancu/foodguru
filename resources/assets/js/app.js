/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Recipe search ajax hints feature
    $('#sidebar-recipe-search').on('input', function(e) {
        let search_box = $(this);
        let word = search_box.val();
        if (word.length > 0) {
            $.get('/ajax/searchIngredientHints/' + word)
                .done(function(words) {
                    let words_array = words.map(word => word.name);
                    search_box.autocomplete({
                        source: words_array
                    });
                });
        }
    });

    $('#navbar-recipe-search').on('input', function(e) {
        let search_box = $(this);
        let word = search_box.val();
        if (word.length > 0) {
            $.get('/ajax/searchIngredientHints/' + word)
                .done(function(words) {
                    let words_array = words.map(word => word.name);
                    search_box.autocomplete({
                        source: words_array
                    });
                });
        }
    });

    // Calendar feature
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: '2014-06-12',
        defaultView: 'month',
        events: [{
                title: 'All Day Event',
                start: '2014-06-01'
            },
            {
                title: 'Long Event',
                start: '2014-06-07',
                end: '2014-06-10'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2014-06-09T16:00:00'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2014-06-16T16:00:00'
            },
            {
                title: 'Meeting',
                start: '2014-06-12T10:30:00',
                end: '2014-06-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2014-06-12T12:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2014-06-13T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2014-06-28'
            }
        ],
        dayClick: function(date, allDay, jsEvent, view) {
            if (allDay) {
                var toDate = new Date(date);
                // Clicked on the entire day
                $('#calendar')
                    .fullCalendar('changeView', 'agendaDay');
                $('#calendar').fullCalendar('gotoDate', toDate);
            }
        }
    });

    /*
     * Add event javascript
     */
    $('#add-event #date').bootstrapMaterialDatePicker({
        time: false,
        clearButton: true
    });
    $('#add-event #start_time').bootstrapMaterialDatePicker({
        date: false,
        shortTime: false,
        format: 'HH:mm'
    });
    $('#add-event #end_time').bootstrapMaterialDatePicker({
        date: false,
        shortTime: false,
        format: 'HH:mm'
    });

    /*
     * Events Table select all
     */

    $("#mytable #checkall").click(function() {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function() {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function() {
                $(this).prop("checked", false);
            });
        }
    });

    $("[data-toggle=tooltip]").tooltip();
});
