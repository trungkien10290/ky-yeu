$(function () {
    $('[name="project[]"]').change(function () {
        let _this = $(this);
        console.log(_this.val())
    })
})
