<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    use HasFactory;

    protected $table = 'admin_user_projects';
    public $timestamps = false;

    public function bugs()
    {
        return $this->belongsToMany(Bug::class, 'admin_user_project_bugs', 'user_project_id', 'bug_id');
    }

    public function permissions()
    {
        return $this->morphToMany(Permission::class, 'model', 'admin_model_permissions');
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
