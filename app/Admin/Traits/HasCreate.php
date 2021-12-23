<?php

namespace App\Admin\Traits;

use Encore\Admin\Layout\Content;

trait HasCreate
{
    public function create(Content $content)
    {
        return $content
            ->title($this->title)
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }

    public function store()
    {
        return $this->form()->store();
    }
}
