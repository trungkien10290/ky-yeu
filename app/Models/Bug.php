<?php

namespace App\Models;

use App\Services\ProjectCategoryStatisticService;
use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * App\Models\Bug
 *
 * @property int $id
 * @property int|null $project_id
 * @property int|null $category_id
 * @property string|null $code
 * @property string $date
 * @property string|null $desc_vi
 * @property array|null $bug_images
 * @property array|null $bug_files
 * @property string|null $desc_en
 * @property string|null $reason_vi
 * @property string|null $reason_en
 * @property string|null $consequence_vi
 * @property string|null $consequence_en
 * @property string|null $solution_vi
 * @property string|null $solution_en
 * @property array|null $solution_images
 * @property array|null $solution_files
 * @property int|null $is_active
 * @property-read int|null $comments_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int $bug_files_count
 * @property-read mixed $slug_link
 * @property-read \App\Models\Project|null $project
 * @method static \Illuminate\Database\Eloquent\Builder|Bug active()
 * @method static \Database\Factories\BugFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bug newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bug projectOwner()
 * @method static \Illuminate\Database\Eloquent\Builder|Bug query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereBugFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereBugImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereCommentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereConsequenceEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereConsequenceVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereDescEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereDescVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereReasonEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereReasonVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereSolutionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereSolutionFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereSolutionImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereSolutionVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bug whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
            ProjectCategoryStatisticService::clearCache();
            try {
                $bug->project()->increment('bugs_count');
            } catch (\Throwable $exception) {
                Log::info($exception->getMessage());
            }
        });
        static::deleted(function (Bug $bug) {
            ProjectCategoryStatisticService::clearCache();
            try {
                $bug->project()->decrement('bugs_count');
            } catch (\Throwable $exception) {
                Log::info($exception->getMessage());
            }
        });
    }

    public function scopeProjectOwner($query)
    {
         $ownerProject = fn_admin()->projectOwnerIds;
        return $query->whereIn('project_id', $ownerProject);
    }

    public function canDelete()
    {
        return fn_admin()->canProject('delete', $this->project);
    }
}
