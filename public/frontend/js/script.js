$(document).ready(function() {
    $('input[name="dates"]').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "alwaysShowCalendars": true,
        "drops": "auto"
    });



})
$(document).on('submit', '.form_modal', function(e) {
    e.preventDefault();
    url = $(this).attr('action');
    var formData = new FormData(this);
    let TotalFiles = $('#files')[0].files.length;
    var content = $(this).find('input[name=content]');
    let files = $('#files')[0];
    for (let i = 0; i < TotalFiles; i++) {
        formData.append('files' + i, files.files[i]);
    }
    formData.append('content', content);
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            alert('Data: ' + data);
        },
        error: function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });
})