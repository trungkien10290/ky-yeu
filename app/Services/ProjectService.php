<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function getAllActive()
    {
        return Project::active()->get();
    }

    public function find($id)
    {
        return Project::find($id);
    }
}
