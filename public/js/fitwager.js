"use strict"
$(document).ready(function () {

// Apply the date range picker with custom settings to the button
$('#picker').daterangepicker({
    format: 'MM/DD/YYYY',
    startDate: moment().subtract(29, 'days'),
    endDate: moment(),
    minDate: '09/09/2016',
    maxDate: '12/31/2020',
    dateLimit: { days: 60 },
    showDropdowns: true,
    showWeekNumbers: true,
    timePicker: false,
    timePickerIncrement: 1,
    timePicker12Hour: true,
    opens: 'right',
    drops: 'up',
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


// ------------------   BAR CHART JS ----------------------//
$(function () {
    console.log( graphInfo.steps, graphInfo.calories, graphInfo.distance);
    $('#barChart').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<span style="font-size: 32px; color: #888888">my</span><span style="font-size: 32px; color: #00d053">activity</span>'
        },
        xAxis: {
            categories: graphInfo.categories
        },
        yAxis: {
            min: 0,
            title: {
                text: '<span style="font-size:20px">data</span>'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.1,
                borderWidth: 1
            }
        },
        series: [{
            name: '<span style="font-size: 16px;">Steps</span>',
            data: graphInfo.steps

        }, {
            name: '<span style="font-size: 16px;">Distance(m)</span>',
            data: graphInfo.distance
        },
            {
            name: '<span style="font-size: 16px;">Calories</span>',
            data: graphInfo.calories

        }]
    });
});

//----------- CHALLENGE TYPE TOOL TIPS ------------//

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});