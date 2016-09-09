
$('#activeTab').click(function() {
    $('#pendingTable').hide();
    $('#activeTable').show();
    $('#historicTable').hide();
});

$('#historicTab').click(function() {
    $('#pendingTable').hide();
    $('#activeTable').hide();
    $('#historicTable').show();
});

$('#pendingTab').click(function() {
    $('#pendingTable').show();
    $('#activeTable').hide();
    $('#historicTable').hide();
});

$('#competitiveRadio').click(function() {
    $('#targetScoreForm').val("");
    $('#targetScore').hide();

});

$('#personalRadio').click(function() {
    $('#targetScore').show();
});

$('#unitedRadio').click(function() {
    $('#targetScore').show();
});

$('#motivateRadio').click(function() {
    $('#targetScore').show();
});

$('#sharedRadio').click(function() {
    $('#targetScore').show();
});