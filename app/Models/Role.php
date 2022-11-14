<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id';
    protected $keyType='string';
    public $incrementing = false;
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
 
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
 
    public function addPermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->first();
        }
 
        return $this->permissions()->attach($permission);
    }
 
    public function removePermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->first();
        }
 
        return $this->permissions()->detach($permission);
    }
}
