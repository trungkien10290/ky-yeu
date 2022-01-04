<?php

namespace App\Services;

use App\Models\Bug;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

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

    public static function makeStatisticData()
    {
    }

    public function getAmoutBugByCategory($projectId, $categoryId)
    {
    }
}
