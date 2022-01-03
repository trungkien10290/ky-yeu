<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Bug extends Model
{
    use HasFactory, HasTranslation;


    protected $casts = [
        'bug_images' => 'array',
        'solution_images' => 'array',
        'bug_files' => 'array',
        'solution_files' => 'array',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getSlugLinkAttribute()
    {
        return 'bug/' . $this->id;
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getBugFilesCountAttribute(): int
    {
        return count_array($this->bug_files);
    }

    public function getSolutionFilesCount(): int
    {
        return count_array($this->solutions_files);
    }

    protected static function booted()
    {
        static::created(function (Bug $bug) {
            try {
                $bug->project()->increment('bugs_count');
            } catch (\Throwable $exception) {
                Log::info($exception->getMessage());
            }
        });
        static::deleted(function (Bug $bug) {
            try {
                $bug->project()->decrement('bugs_count');
            } catch (\Throwable $exception) {
                Log::info($exception->getMessage());
            }
        });
    }

    public function scopeProjectOwner($query)
    {
        $ownerProject = fn_admin()->projectPermissions->pluck('project_id');
        return $query->whereIn('project_id', $ownerProject);
    }

    public function canDelete()
    {
        return fn_admin()->canProject('delete', $this->project);
    }
}
