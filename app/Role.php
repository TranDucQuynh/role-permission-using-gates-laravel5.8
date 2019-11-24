<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'permissions',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'role_users');
    }

    public function hasAccess(array $permissions)
    {
        foreach ($permissions as $permission){
            if($this->hasPermission($permission)){
                return true;
            }
        }
        return false;
    }

    public function hasPermission(string $permission)
    {
        $permissions = json_decode($this->permissions, true);
//        return $permissions[$permission]?$permissions[$permission]:false;
        return $permissions[$permission]??false;
    }
}
