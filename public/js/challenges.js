
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
