<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

/**
 * Role
 * Roles model
 *
 * @author Bastien Nicoud
 * @package App
 */
class Role extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'permissions'
    ];

    /**
     * MODEL PROPERTY
     * The attributes that should be cast to native types.
     * (Here serialize and deserialize the permissions field to native php array)
     *
     * @var array
     */
    protected $casts = [
        'permissions' => 'array'
    ];

    /**
     * MODEL RELATION
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * MODEL METHOD
     * Return true if the role have access to this specific permission
     *
     * @return string
     */
    public function can(string $permission)
    {
        return $this->permissions[$permission] ?? false;
    }
}
