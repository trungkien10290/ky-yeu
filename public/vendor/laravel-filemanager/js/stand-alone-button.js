(function ($) {


    function IsJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    $(document).on('click', '.preview_multiple_file .delete', function (e) {
        e.preventDefault();
        $(this).parent().remove();
    })

    $.fn.filemanager = function (type, options) {
        type = $(this).data('type') ?? 'file';
        var target_input = $('#' + $(this).data('input'));
        var target_preview = $('#' + $(this).data('preview'));
        var is_multiple = $(this).data('is_multiple')
        target_input.change(function () {
            let value = $(this).val();
            if (!is_multiple) {
                target_preview.html('');
            }
            target_preview.append(
                $('<img>').css('height', '100px').attr('src', value)
            );
        })

        this.on('click', function (e) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
            var name = target_input.attr('name');
            target_input = $('#' + $(this).data('input'));

            target_preview = $('#' + $(this).data('preview'));
            is_multiple = $(this).data('is_multiple')
            window.open(route_prefix + '?type=' + type, 'FileManager', 'width=1200,height=700');
            window.SetUrl = function (items) {
                let items_url = items.map(function (item) {
                    return item.url.replace(baseUrl, '');
                });
                if (is_multiple) {
                    let currentValue = target_input.val();
                    currentValue = IsJsonString(currentValue) ? JSON.parse(currentValue) : [];
                    currentValue = currentValue.concat(items_url);
                    renderMultipleItem(currentValue, name)
                } else {
                    target_input.val('').val(items_url[0]).trigger('change');
                    target_preview.html('');
                    if (items_url[0]) {
                        target_preview.html(renderItemPreview(items_url[0], null, items_url[0]))
                    }
                }
                window.close();

                // trigger change event
                target_preview.trigger('change');
            };
            return false;
        });

        function renderItemPreview(src, name, value) {
            if (!src) return;
            let info = src.split('.');
            let extension = info.pop();
            src = isImage(extension) ? src : '/admins/ico/' + extension + '.jpg';
            return `<div class="item_multiple_preview">
                <i class="fa fa-trash delete"></i>
                ${extension !== 'mp4' ? `<img src="${src}" alt="" height="100">` : ` <video src="${value}" height="100" controls><source src="${value}"  type="video/mp4"></video>`}
                ${name ? `<input type="hidden" name="${name}[]" value="${value}">` : ''}
            </div>`;

        }

        function isImage(extension) {
            return $.inArray(extension.toLowerCase(), ['jpg', 'jpeg', 'png', 'svg', 'gif']) !== -1
        }

        function renderMultipleItem(lists, name) {
            lists.forEach(function (value) {
                target_preview.append(renderItemPreview(value, name, value));
            });
            // target_input.val(JSON.stringify(lists));
        }

        $(this).trigger('click')
    }

    $(document).on('click', '.lfm-btn', function () {
        $(this).filemanager('image', {prefix: '/admin/filemanager'});
    })

})(jQuery);
