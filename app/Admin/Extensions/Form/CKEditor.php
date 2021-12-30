<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class CKEditor extends Field
{
    public static $js = [
        '/packages/ckeditor/ckeditor.js',
        '/packages/ckeditor/adapters/jquery.js',
    ];

    protected $view = 'admin.form.editor';

    public function getElementClassString()
    {
        return 'ckEditor';
    }

    public function render()
    {
        $this->script = <<<"EOT"
initEditor()
EOT;


        return parent::render();
    }
}
