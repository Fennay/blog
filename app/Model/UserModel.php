<?php

namespace App\Model;

use DB;

class UserModel extends BaseModel
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->model = DB::table('user');
    }
}
