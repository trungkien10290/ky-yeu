<?php

namespace Encore\Admin\Grid\Actions;

use Encore\Admin\Actions\RowAction;

class Show extends RowAction
{


    protected $label = 'info';
    /**
     * @return array|null|string
     */


    public function name()
    {
        return __('admin.show');
    }

    /**
     * @return string
     */
    public function href()
    {
        return "{$this->getResource()}/{$this->getKey()}";
    }

    public function render()
    {
        return "<a class='btn btn-xs btn-info' href='{$this->href()}'>{$this->name()}</a>";
    }
}
