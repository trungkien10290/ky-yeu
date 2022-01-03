let ajaxLoading = false;
let csrf_token = $('meta[name="csrf-token"]').attr('content');
let _doc = $(document);
let options_select2 = {};
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrf_token
    }
});
