const SEO = {
    form: $('#main_form'),
    init: function () {
        this.title();
        this.description();
    },
    title: function () {
        let idSlug = this.form.find("[name='slug']");
        let idMetaTitle = this.form.find("[name='meta_title']");
        this.action_input("[name='title']", (value) => {
            SEO.generate_slug(value, idSlug);
            SEO.paste_value(value, idMetaTitle);
        });
    },
    description: function () {
        let idMetaDescription = this.form.find("[name='meta_description']");
        this.action_input("[name='description']", (value) => {
            SEO.paste_value(value, idMetaDescription);
        });
    },
    action_input: function (id, callback) {
        this.form.on("keyup", id, function () {
            let value = $(this).val();
            if (typeof callback === "function") {
                callback(value);
            }
        });
        this.form.on("paste", id, function () {
            let value = $(this).val();
            if (typeof callback === "function") {
                callback(value);
            }
        });
    },
    paste_value: function (value, id) {
        $(id).val(value);
    },
    generate_slug: function (value, id) {
        let slug = value.toLowerCase();
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        slug = slug.replace(/[^a-zA-Z0-9 ]/g, "");
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        $(id).val(slug);
    }
}

function initTinyMCE() {
    console.log('init')
    tinymce.init({
        height: "250",
        selector: "textarea.tinyMCE",
        file_picker_types: 'image',
        images_upload_base_path: '/',
        location: '/',
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function () {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function () {
                    uploadImage(file, function (data) {
                        cb(image_upload_domain + '/' + data.url, {title: file.name});
                    })
                };
                reader.readAsDataURL(file);
            };

            input.click();
        },
        setup: function (ed) {
            ed.on('DblClick', function (e) {
                if (e.target.nodeName == 'IMG') {
                    tinyMCE.activeEditor.execCommand('mceImage');
                }
            });
        },
        plugins: [
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "  visualblocks visualchars code fullscreen  nonbreaking",
            "table contextmenu directionality emoticons textcolor paste textcolor textpattern link code image",
        ],

        toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | code styleselect formatselect fontselect fontsizeselect cut copy paste  | bullist numlist | outdent indent blockquote  | table | hr removeformat | subscript superscript | charmap emoticons |  fullscreen | ltr rtl | spellchecker | link | image",
        toolbar2: false,
        menubar: false,
        branding: false,
        statusbar: false,
        element_format: 'html',
        extended_valid_elements: "iframe[src|width|height|name|align], embed[width|height|name|flashvars|src|align|play|loop|quality|allowscriptaccess|type|pluginspage]",
        toolbar_items_size: 'small',
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        verify_html: false,

    });
}
