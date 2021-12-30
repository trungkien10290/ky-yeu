<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class File extends IsFilePicker
{
    protected $type = 'file';
    protected $view = 'admin.form.file';
}
