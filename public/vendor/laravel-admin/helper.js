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
function initEditor() {
    var options = {
        filebrowserImageBrowseUrl: '/admin/filemanager?type=Images',
        filebrowserBrowseUrl: '/admin/filemanager?type=Files',
        removeDialogTabs: 'image:advanced;image:Link',
        image_previewText:''
    };
    var editor = $('textarea.ckEditor').ckeditor(options);
}

