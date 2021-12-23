<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class TinyMCE extends Field
{
    public static $js = [
    ];

    protected $view = 'admin.form.editor';

    public function getElementClassString()
    {
        return 'tinyMCE';
    }

    public function render()
    {
        $this->script = "Libraries.push('initTinyMCE')";

        return parent::render();
    }
}
