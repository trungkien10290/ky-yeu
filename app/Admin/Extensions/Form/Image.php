<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class Image extends IsFilePicker
{
    protected $type = 'image';
    protected $view = 'admin.form.file';
}
