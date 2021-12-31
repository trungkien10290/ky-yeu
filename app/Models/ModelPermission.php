<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPermission extends Model
{
    use HasFactory;

    protected $table = 'admin_model_permissions';

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function model()
    {
        return $this->morphTo();
    }
}
