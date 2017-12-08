<?php

namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Eloquent;

class UserModel extends Eloquent
{
    use HasRoles;
    use SoftDeletes;
    protected $guard_name = 'admin';
    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'email',
        'telephone',
        'sex',
        'status',
        'sort',
        'created_at',
        'updated_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * 判断用户是否具有某个角色
     * @param $role
     * @return bool
     * @author: Mikey
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    /**
     * 判断用户是否具有某权限
     * @param $permission
     * @return bool
     * @author: Mikey
     */
    public function hasPermission($permission)
    {
        return $this->hasRole($permission->roles);
    }


    /**
     * 给用户分配角色
     * @param $role
     * @return mixed
     * @author: Mikey
     */
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }
}
