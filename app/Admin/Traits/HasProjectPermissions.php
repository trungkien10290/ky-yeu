<?php

namespace App\Admin\Traits;

trait HasProjectPermissions
{
    public function projectPermissions()
    {
    }

    public function canProject($action, $project): bool
    {
        dd($this->projectPermissions);
        return true;
    }

    public function cannotProject($action, $project): bool
    {
        return !$this->canProject($action, $project);
    }
}
