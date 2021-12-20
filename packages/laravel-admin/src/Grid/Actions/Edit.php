<?php

namespace Encore\Admin\Grid\Actions;

use Encore\Admin\Actions\RowAction;

class Edit extends RowAction
{
    protected $label = 'primary';

    /**
     * @return array|null|string
     */
    public function name()
    {
        return __('admin.edit');
    }

    /**
     * @return string
     */
    public function href()
    {
        return "{$this->getResource()}/{$this->getKey()}/edit";
    }

    public function render()
    {
            return "<a class='btn btn-xs btn-primary' href='{$this->href()}'>{$this->name()}</a>";
    }
}
