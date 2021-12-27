<?php

namespace App\Services;

use App\Models\Bug;
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
        if (request('search')) {
            $query->where('desc_' . get_lang(), 'like', '%' . request('search') . '%');
        }

        return $query->orderByDesc('id')->paginate(self::PAGINATE_LIMIT);
    }
}
