<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/11/20 - 18:59
 */

namespace App\Repositories;

use App\Exceptions\HomeException;
use App\Model\UserModel;
use Illuminate\Database\QueryException;

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
     * @throws HomeException
     * @author: Mikey
     */
    public function saveInfo(array $data)
    {
        $saveData = [
            'id'        => empty($data['id']) ? '' : $data['id'],
            'username'  => $data['username'],
            'email'     => empty($data['email']) ? '' : $data['email'],
            'telephone' => empty($data['telephone']) ? '' : $data['telephone'],
            'sex'       => empty($data['sex']) ? 0 : $data['sex'],
            'status'    => empty($data['status']) ? 0 : $data['status']
        ];

        // 添加时，密码可不填，默认为 123456
        // 编辑时，密码也可不填，不填则不修改，填了表示修改密码
        if (empty($data['id'])) {
            $data['password'] = empty($data['password']) ? 123456 : $data['password'];
            $saveData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            // 添加数据时，设置排序值等于ID本身
            $lastUid = $this->userModel->findOne([]);
            $lastUid = empty($lastUid->id) ? 0 : $lastUid->id;
            $saveData['sort'] = $lastUid + 1;
        } else {
            !empty($data['password']) && $saveData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        try {
            return $this->userModel->saveInfo($saveData);
        } catch (QueryException $exe) {
            throw new HomeException('数据保存失败');
        }
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
     * @param $pageSize
     * @return mixed
     * @author: Mikey
     */
    public function getUserPageList($pageSize = 10)
    {
        return $this->userModel->getPageList([], $pageSize, ['sort' => 'desc', 'id' => 'desc']);
    }
}