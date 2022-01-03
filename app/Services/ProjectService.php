<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function getAllActive()
    {
        return Project::active()->get();
    }
}
