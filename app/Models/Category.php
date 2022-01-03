<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string|null $title_vi
 * @property string|null $title_en
 * @property string|null $type
 * @property string|null $desc_vi
 * @property string|null $desc_en
 * @property string|null $content_vi
 * @property string|null $content_en
 * @property string|null $thumbnail
 * @property string|null $banner
 * @property string|null $logo
 * @property int|null $parent_id
 * @property int|null $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $slug_link
 * @property-read Category|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|Category active()
 * @method static \Database\Factories\CategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereContentEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereContentVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitleVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory,HasTranslation;

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getSlugLinkAttribute()
    {
        return 'category/' . $this->id;
    }
}
