<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    use HasFactory;


    public function projectCategory()
    {
        return $this->belongsTo(Category::class, 'project_category_id');
    }

    public function otherCategory()
    {
        return $this->belongsTo(Category::class, 'other_category_id');
    }

    public function bugCategory()
    {
        return $this->belongsTo(Category::class, 'bug_category_id');
    }
}
