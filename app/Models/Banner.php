<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Banner
 *
 * @property int $id
 * @property string|null $title_vi
 * @property string|null $desc_vi
 * @property string|null $thumbnail
 * @property string|null $video
 * @property int|null $position
 * @property string|null $title_en
 * @property string|null $desc_en
 * @property int|null $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image
 * @method static \Illuminate\Database\Eloquent\Builder|Banner active()
 * @method static \Database\Factories\BannerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereDescEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereDescVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereTitleVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereVideo($value)
 * @mixin \Eloquent
 */
class Banner extends Model
{
    use HasFactory, HasTranslation;

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getImageAttribute()
    {
        return $this->thumbnail;
    }
}
