<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string|null $title_vi
 * @property string|null $title_en
 * @property string|null $desc_vi
 * @property string|null $desc_en
 * @property string|null $content_vi
 * @property string|null $content_en
 * @property string|null $thumbnail
 * @property int|null $parent_id
 * @property int|null $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContentEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContentVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDescEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDescVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitleVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory,HasTranslation;
}
