<?php

namespace Encore\Admin\Form\Field;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Video extends File
{


    protected $view = 'admin::form.file';


    public function render()
    {
        $this->options(['allowedFileTypes' => ['video'], 'msgPlaceholder' => trans('admin.choose_video')]);
        return parent::render();
    }


}
