<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    const OTHER_PROJECT_LIMIT = 3;
    public function getAllActive()
    {
        return Project::active()->get();
    }

    public function find($id)
    {
        return Project::active()->find($id);
    }

    public function otherProjects($id, $limit = self::OTHER_PROJECT_LIMIT)
    {
        return Project::active()->where('id', '!=', $id)->limit($limit)->orderByDesc('id')->get();
    }
}
