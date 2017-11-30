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
     * @param array $data
     * @return mixed
     * @author: Mikey
     */
    public function saveInfo(array $data)
    {
        $saveData = [
            'id'        => empty($data['id']) ? '' : $data['id'],
            'username'  => $data['username'],
            'email'     => empty($data['email']) ? '' : $data['email'],
            'telephone' => empty($data['telephone']) ? '' : $data['telephone'],
            'sex'       => empty($data['sex']) ? 1 : $data['sex']
        ];

        // 密码不为空，则进行加密
        // 修改信息是，密码可为空，表示不修改密码
        if (!empty($data['password'])) {
            $saveData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->userModel->saveInfo($saveData);
    }

    /**
     * 删除
     * @param $uid
     * @return mixed
     * @author: Mikey
     */
    public function delUserByUid($uid)
    {
        return $this->userModel->del($uid);
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
     * 通过uid获取用户信息
     * @param $uid
     * @return mixed
     * @author: Mikey
     */
    public function getUserInfoByUid($uid)
    {
        return $this->userModel->getOne($uid);
    }

    /**
     * 获取分页数据
     * @author: Mikey
     */
    public function getUserPageList()
    {
        return $this->userModel->getPageList([], $pageSize = 10, ['sort' => 'desc', 'id' => 'desc']);
    }
}