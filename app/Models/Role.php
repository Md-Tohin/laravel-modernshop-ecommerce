<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->hasMany(Role::class);
    }

    public function permission(){
        return $this->hasOne(Permission::class);
    }
}
