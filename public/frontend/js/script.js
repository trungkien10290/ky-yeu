window.alert = function (message) {
    console.warn(message)
}
window.locale = $('html').attr('lang')
window.languages = {}
$(document).ready(function () {
    initDaterangePicker();
    $('#form-search-bug').on('change', 'select,.date-range-picker', function () {
        $(this).closest('form').submit()
    })
})

function lang(key) {
    return i18n[key] ?? key;
}

function initDaterangePicker() {
    let input = $('.date-range-picker');
    let ranges = {};
    ranges[lang('Today')] = [moment(), moment()];
    ranges[lang('Yesterday')] = [moment().subtract(1, 'days'), moment().subtract(1, 'days')]
    ranges[lang('Last 7 Days')] = [moment().subtract(6, 'days'), moment()]
    ranges[lang('Last 30 Days')] = [moment().subtract(29, 'days'), moment()]
    ranges[lang('This Month')] = [moment().startOf('month'), moment().endOf('month')]
    ranges[lang('Last Month')] = [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    input.daterangepicker({
        ranges: ranges,
        "alwaysShowCalendars": true,
        "drops": "auto",
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            "customRangeLabel": lang('Custom range'),
            "daysOfWeek": [
                "Su",
                "Mo",
                "Tu",
                "We",
                "Th",
                "Fr",
                "Sa"
            ],
        }
    });
    input.on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY')).trigger('change');
    });
    input.on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('').trigger('change');
    });
}

$(document).on('change', '#files', function (e) {
    let text_element = $('#file-count-text');
    if (this.files.length) {
        text_element.removeClass('d-none').children('span').text(this.files.length);
    } else {
        text_element.addClass('d-none')
    }
})

let isLoading = false;
$(document).on('submit', '.form_modal', function (e) {
    e.preventDefault();
    if (isLoading) return;
    isLoading = true;
    let _this = $(this);
    let url = _this.attr('action');
    var formData = new FormData(_this[0]);
    _this.find('button[type="submit"]').prop('disabled', true);
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
    }).done(function () {
        isLoading = false;
        _this.find('button[type="submit"]').prop('disabled', false);

    })
})
