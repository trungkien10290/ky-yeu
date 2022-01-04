<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string|null $title_vi
 * @property string|null $title_en
 * @property string|null $desc_vi
 * @property string|null $desc_en
 * @property string|null $content_vi
 * @property string|null $content_en
 * @property string|null $thumbnail
 * @property string|null $logo
 * @property int|null $is_active
 * @property-read int|null $bugs_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bug[] $bugs
 * @property-read mixed $slug_link
 * @method static \Illuminate\Database\Eloquent\Builder|Project active()
 * @method static \Database\Factories\ProjectFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereBugsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereContentEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereContentVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTitleVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function bugs()
    {
        return $this->hasMany(Bug::class);
    }

    public function canDelete()
    {
        return fn_admin()->canProject('delete', $this);
    }

    public static function getAllCanView()
    {
        if (is_super_admin()) {
            return static::all();
        } else {
            return fn_admin()->projects;
        }
    }
}
