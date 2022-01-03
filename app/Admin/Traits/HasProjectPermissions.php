<?php

namespace App\Admin\Traits;

use App\Models\UserProject;

trait HasProjectPermissions
{
    protected $permissionByProject;

    public function projectPermissions()
    {
        return $this->hasMany(UserProject::class, 'user_id', 'id');
    }

    public function permissionByProject()
    {
        if (!$this->permissionByProject) {
            $this->permissionByProject = $this->projectPermissions->keyBy('project_id')->toArray();
        }
        return $this->permissionByProject;
    }

    public function hasProjectPermission($action, $project)
    {
        return !empty($this->permissionByProject()) && in_array($action, $this->permissionByProject[$project->id]['permissions']);
    }

    public function canProject($action, $project): bool
    {
        return $this->isAdministrator() || $this->hasProjectPermission($action, $project);
    }

    public function cannotProject($action, $project): bool
    {
        return !$this->canProject($action, $project);
    }
}
