<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * 公用基类model方法
 * @package App\Model
 */
class BaseModel extends Model
{

    /**
     * @var
     */
    protected $model;

    /**
     * 该模型是否被自动维护时间戳
     * @var bool
     */
    public $timestamps = true;

    /**
     * 取一个
     * @param $id
     * @return mixed
     */
    public function getOne($id)
    {
        return $this->applyWhere(['id' => $id])->applyOrder(['id' => 'desc'])->first();
    }

    /**
     * 根据条件取一个
     * @param array $where
     * @param array $order
     * @return mixed
     */
    public function findOne(array $where, array $order = ['id' => 'desc'])
    {
        return $this->applyWhere($where)->applyOrder($order)->first();
    }

    /**
     * 根据条件读取列表
     * @param array $where
     * @param int   $size
     * @param array $order
     * @param int   $skip
     * @return mixed
     */
    public function getList(array $where, $size = null, $order = ['id' => 'desc'], $skip = null)
    {
        return $this->applyWhere($where)->applyOrder($order)->take($size)->skip($skip)->get();
    }

    /**
     * 创建或者是修改
     * @param        $saveData
     * @param string $primayKey
     * @return mixed 创建成功返回成功后的主键Id，修改成功返回受影响的记录行数
     * @author: Mikey
     */
    public function saveInfo($saveData, $primayKey = 'id')
    {
        //if (!empty($sveData[$primayKey])) {
        //    return $this->model->update($saveData);
        //} else {
        //    return $this->model->insertGetId($saveData);
        //}

        $this->fill($saveData);
        parent::save();
    }

    /**
     * 组合where参数
     * @param array $where
     * @return mixed
     */
    public function applyWhere(array $where)
    {
        //例如 ['name' => ['like'=> 'sss']]
        foreach ($where as $key => $value) {

            // 如果第二个参数是字符串，则表示默认使用 = 操作符
            if (!is_array($value['1'])) {
                $this->where($key, $value);

                return $this;
            }

            // 第二个参数是数组
            switch (!empty($value['0']) && strtolower($value['0'])) {
                case 'in' :
                    $this->model->whereIn($key, $value[1]);
                    break;
                case 'between' :
                    // 例子 $where = ['age',['between',[1,10]]];
                    $this->model->whereBetween($key, $value[1]);
                    break;
                case 'notbetween' :
                    // 例子 $where = ['age',['notbetween',[1,10]]];
                    $this->model->NotBetween($key, $value[1]);
                    break;
                default:
                    $this->model->where($key, $value[0], $value[1]);
            }

        }

        return $this;
    }

    /**
     * 组装order
     * @param array $order
     * @return mixed
     */
    public function applyOrder(array $order)
    {
        // 例如：['sort' => 'desc','id' => 'desc']
        foreach ($order as $field => $option) {
            $this->model = $this->model->orderBy($field, $option);
        }

        return $this;
    }

    public function getPageList(array $where, array $order, $pageSize = 10, $field = '*', $pageName = 'page')
    {
        return $this->applyWhere($where)
            ->applyOrder($order)
            ->paginate($pageSize, $field, $pageName);
    }

    public function clearCache()
    {

    }
}
