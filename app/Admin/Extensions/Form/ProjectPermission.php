<?php

namespace App\Admin\Extensions\Form;

use App\Models\Project;
use Encore\Admin\Form\Field;

class ProjectPermission extends Field
{

    protected $view = 'admin.form.project_permission';

    public function render()
    {
        $this->addVariables(['projects' => Project::all()]);
        return parent::render();
    }
}
