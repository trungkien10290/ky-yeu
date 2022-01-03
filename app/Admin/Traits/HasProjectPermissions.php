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
        $id = $project->id ?? null;
        return !empty($this->permissionByProject()) && in_array($action, $this->permissionByProject[$id]['permissions']);
    }

    public function canProject($action, $project): bool
    {
        return $this->isAdministrator() || $this->hasProjectPermission($action, $project);
    }

    public function cannotProject($action, $project): bool
    {
        return !$this->canProject($action, $project);
    }

    public function getProjectOwnerIdsAttribute()
    {
        return $this->projectPermissions->pluck('project_id');
    }
}
