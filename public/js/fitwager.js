"use strict"
$(document).ready(function () {

// Apply the date range picker with custom settings to the button
$('#picker').daterangepicker({
    format: 'MM/DD/YYYY',
    startDate: moment().subtract(29, 'days'),
    endDate: moment(),
    minDate: '09/01/2016',
    maxDate: '12/31/2020',
    dateLimit: { days: 60 },
    showDropdowns: true,
    showWeekNumbers: true,
    timePicker: false,
    timePickerIncrement: 1,
    timePicker12Hour: true,
    opens: 'right',
    drops: 'right',
    buttonClasses: ['btn', 'btn-sm'],
    applyClass: 'btn-primary',
    cancelClass: 'btn-default',
    separator: ' to ',
    locale: {
        applyLabel: 'Submit',
        cancelLabel: 'Cancel',
        fromLabel: 'From',
        toLabel: 'To',
        customRangeLabel: 'Custom',
        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        firstDay: 1
    }
}, function(start, end, label) {
    $('#picker span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
});

});

$('#create_challenge_button').click(function (event){
    event.preventDefault();
    var date_range = $('#picker span').html().split(' - ');
    var startDate = date_range[0];
    var endDate = date_range[1];
    var formattedStartDate = moment(new Date(startDate)).format('YYYY-MM-DD');
    var formattedEndDate = moment(new Date(endDate)).format('YYYY-MM-DD');

    $('#hidden-start-date').val(formattedStartDate);
    $('#hidden-end-date').val(formattedEndDate);
    $('#user_parameters').submit();
});
// ------------------   END OF DATE RANGE PICKER JS  ----------------------//

$(document).ready(function(){
    $("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });

    $("[data-toggle=tooltip]").tooltip();


});

// takes the 'input' from date picker and formats it into dates that can be used for our sql queries


