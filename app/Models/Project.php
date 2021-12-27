<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, HasTranslation;

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getSlugLinkAttribute()
    {
        return 'project/' . $this->id;
    }

    public function getSearchLinkAttribute()
    {
        return 'dasdsa';
    }
}
