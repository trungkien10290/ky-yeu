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
    let url = $(this).attr('action');
    var formData = new FormData($(this)[0]);
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
            if (data.html !== '') {
                $('.box_view').append(data.html)
            } else {

            }
        },
        error: function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });
})
