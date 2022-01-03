<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class MultipleFile extends IsFilePicker
{
    protected $type = 'file';

    protected $view = 'admin.form.multiple_file';

    public function render()
    {
        $this->addVariables([
            'is_multiple' => true,
            'btn_class'=>'lfm-btn'
        ]);

        return parent::render();
    }
}
