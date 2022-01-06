<?php

namespace App\Services;

use App\Models\Bug;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class BugService
{
    const PAGINATE_LIMIT = 20;

    public function paginate(): LengthAwarePaginator
    {
        $query = Bug::active();
        if (request('project_id')) {
            $query->where('project_id', request('project_id'));
        }
        if (request('category_id')) {
            $query->where('category_id', request('category_id'));
        }
        if (request('dates')) {
            $dates = explode(' - ', request('dates'));
            if ($dates) {
                $from = Carbon::createFromDate($dates[0])->toDateTimeString();
                if (!empty($dates[1])) {
                    $to = Carbon::createFromDate($dates[1])->toDateTimeString();
                } else {
                    $to = date('Y-m-d');
                }
            }
            $query->whereBetween('date', [$from, $to]);
        }
        if (request('search')) {
            $query->where(function ($query) {
                $search = request('search');
                if (is_numeric($search)) {
                    $query->orWhere('id', $search);
                }
                $query->orwhere('desc_' . get_lang(), 'like', '%' . $search . '%');
            });
        }
        return $query->orderByDesc('id')->paginate(self::PAGINATE_LIMIT);
    }

    public function findOrFail($id)
    {
        $checkId = Bug::findOrFail($id);
        if ($checkId) {
            return true;
        }
        return false;
    }
}
