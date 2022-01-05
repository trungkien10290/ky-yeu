<?php

namespace App\Services;

use App\Models\Bug;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProjectCategoryStatisticService
{
    const CACHE_SECONDS = 60 * 60;
    const CACHE_KEY = 'project_category_statistics';
    private $data;

    public static function makeData()
    {
        DB::table('project_category_statistics')->truncate();
        $bugs = Bug::selectRaw('project_id ,category_id, count(id) as bugs_count')->groupBy(['project_id', 'category_id'])->get()->toArray();
        if (!empty($bugs)) {
            DB::table('project_category_statistics')->insert($bugs);
        }
    }

    public function getKeyStatistic($projectIOd, $categoryId)
    {
        return 'project_' . $projectIOd . '.category_' . $categoryId;
    }

    public function data()
    {
        if (!$this->data) {
            $this->data = cache()->remember(self::CACHE_KEY, self::CACHE_SECONDS, function () {
                $bugs = Bug::selectRaw('project_id ,category_id, count(id) as bugs_count')->where('is_active', 1)->groupBy(['project_id', 'category_id'])->get();
                // $data = DB::table('project_category_statistics')->get();
                $result = [];

                foreach ($bugs as $row) {
                    $key = $this->getKeyStatistic($row->project_id, $row->category_id);
                    $result[$key] = $row->bugs_count;
                }

                return $result;
            });
        }

        return $this->data;
    }

    public function getAmoutBugByCategory($projectId, $categoryId)
    {
        return Arr::get($this->data(), $this->getKeyStatistic($projectId, $categoryId), 0);
    }

    public static function clearCache()
    {
        cache()->forget(self::CACHE_KEY);
    }
}
