<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class IsFilePicker extends Field
{
    protected $type = 'file';
    public static $js = [
        '/vendor/laravel-filemanager/js/stand-alone-button.js',
    ];
    protected $view;

    public function render()
    {
        $this->addVariables(['type' => $this->type]);
        return parent::render();
    }

    public function isFile()
    {
        $this->type = 'file';
    }
    public function isImage()
    {
        $this->type = 'image';
    }

    public function isVideo()
    {
        $this->type = 'video';
    }
}
