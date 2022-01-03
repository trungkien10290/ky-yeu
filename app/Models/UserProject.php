<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserProject
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property array|null $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bug[] $bugs
 * @property-read int|null $bugs_count
 * @property-read \App\Models\Project $project
 * @property-read Administrator $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProject query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProject wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProject whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProject whereUserId($value)
 * @mixin \Eloquent
 */
class UserProject extends Model
{
    use HasFactory;

    protected $table = 'admin_user_projects';
    public $timestamps = false;

    protected $casts = [
        'permissions' => 'array'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(Administrator::class);
    }
}
