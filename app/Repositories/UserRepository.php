<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/11/20 - 18:59
 */

namespace App\Repositories;

use App\Model\UserModel;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository extends BaseRepository
{
    /**
     * @var UserModel
     */
    protected $userModel;

    /**
     * UserRepository constructor.
     * @param UserModel $userModel
     */
    public function __construct(
        UserModel $userModel
    )
    {
        $this->userModel = $userModel;
    }

    /**
     * 保存
     * @param $saveData
     * @return mixed
     * @author: Mikey
     */
    public function saveInfo($saveData)
    {
        return $this->userModel->saveInfo($saveData);
    }

    /**
     * 通过用户名获取用户信息
     * @param $username
     * @return mixed
     * @author: Mikey
     */
    public function getUserInfoByUserName($username)
    {
        return $this->userModel->findOne(['username' => $username]);
    }

    /**
     * @author: Mikey
     */
    public function getUserPageList()
    {
        return $this->userModel->getPageList([], ['sort' => 'desc', 'id' => 'desc'], $pageSize = 10);
    }
}