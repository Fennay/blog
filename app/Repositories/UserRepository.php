<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/11/20 - 18:59
 */

namespace App\Repositories;

use App\Model\UserModel;

class UserRepository extends BaseRepository
{
    protected $userModel;

    public function __construct(
        UserModel $userModel
    )
    {
        $this->userModel = $userModel;
    }

    public function saveInfo($saveData)
    {
        return $this->userModel->saveInfo($saveData);
    }

    public function getUserPageList($size)
    {

    }
}