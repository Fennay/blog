<?php

namespace App\Model;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class UserModel extends Authenticatable
{
    use HasRoles;
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

        $this->model = DB::table($this->table);
    }
}
