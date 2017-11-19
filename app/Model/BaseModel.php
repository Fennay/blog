<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * 公用基类model方法
 *
 * @package App\Model
 */
class BaseModel extends Model
{

    /**
     * @var
     */
    protected $model;

    /**
     * 取一个
     *
     * @param $id
     * @return mixed
     */
    public function getOne($id)
    {
        return $this->applyWhere(['id' => $id])->applyOrder(['id' => 'desc'])->first();
    }

    /**
     * 根据条件取一个
     *
     * @param $where
     * @return mixed
     */
    public function findOne($where)
    {
        return $this->applyWhere($where)->applyOrder(['id' => 'desc'])->first();
    }

    /**
     * 根据条件读取列表
     *
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

    public function saveInfo()
    {
        return $this->model->save();
    }

    /**
     * 组合where参数
     *
     * @param array $where
     * @return mixed
     */
    public function applyWhere(array $where)
    {
        list($field, $value) = $where;

        // 如果第二个参数是字符串，则表示默认使用 = 操作符
        if (empty($value['1'])) {
            return $this->model->where($field, $value);
        }

        // 第二个参数是数组
        switch (strtolower($value['0'])) {
            case 'in' :
                $this->model = $this->model->whereIn($field, $value[1]);
                break;
            case 'between' :
                // 例子 $where = ['age',['between',[1,10]]];
                $this->model = $this->model->whereBetween($field, $value[1]);
                break;
            case 'notbetween' :
                // 例子 $where = ['age',['notbetween',[1,10]]];
                $this->model = $this->model->NotBetween($field, $value[1]);
                break;
            default:
                $this->model = $this->model->where($field, $value[0], $value[1]);
        }

        return $this->model;
    }

    /**
     * 组装order
     *
     * @param array $order
     * @return mixed
     */
    public function applyOrder(array $order)
    {
        // 例如：['sort' => 'desc','id' => 'desc']
        foreach ($order as $field => $option) {
            $this->model = $this->model->orderBy($field, $option);
        }

        return $this->model;
    }

    public function clearCache()
    {

    }
}
