<?php

namespace App\Model;

use DB;

class UserModel extends BaseModel
{

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

        $this->model = DB::table('user');
    }
}
