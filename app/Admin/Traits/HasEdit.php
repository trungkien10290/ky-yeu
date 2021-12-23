<?php

namespace App\Admin\Traits;

use Encore\Admin\Layout\Content;

trait HasEdit
{
    public function update($id)
    {
        return $this->form()->update($id);
    }

    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title)
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

}
