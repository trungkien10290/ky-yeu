<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    use HasFactory;

    protected $table = 'admin_user_projects';
    public $timestamps = false;

    protected $casts = [
        'permissions' => 'array'
    ];

    public function bugs()
    {
        return $this->belongsToMany(Bug::class, 'admin_user_project_bugs', 'user_project_id', 'bug_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(Administrator::class);
    }
}
