window.alert = function (message) {
    console.warn(message)
}
$(document).ready(function () {
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
$(document).on('change', '#files', function (e) {
    let text_element = $('#file-count-text');
    if (this.files.length) {
        text_element.removeClass('d-none').children('span').text(this.files.length);
    } else {
        text_element.addClass('d-none')
    }
})
$(document).on('submit', '.form_modal', function (e) {
    e.preventDefault();
    let _this = $(this);
    let url = _this.attr('action');
    var formData = new FormData(_this[0]);
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
        success: function (data) {
            if (data.html !== '') {
                $('.box_view').append(data.html)
            }
            $('#comment-errors').html('');
            _this[0].reset()
            $('#files').trigger('change');

        },
        error: function (res) {
            let json = res.responseJSON;
            if (typeof json !== "object") {
                return;
            }
            if (json.errors) {
                let html = '';
                $.each(json.errors, function (name, message) {
                    html += `<p>${message}</p>`
                });
                $('#comment-errors').html(html);
            }
        }
    });
})
