<?php
/**
 * Created by PhpStorm.
 * User: Mikey
 * Date: 2017/12/4
 * Time: 22:02
 */

namespace App\Services;

use App\Exceptions\UploadException;

class UploadService
{
    protected $uploadResourcesTmpPath;
    protected $uploadResourcesRealPath;

    public function __construct($uploadResourcesTmpPath, $uploadResourcesRealPath)
    {
        $this->uploadResourcesTmpPath = $uploadResourcesTmpPath;
        $this->uploadResourcesRealPath = $uploadResourcesRealPath;

        // 检查存储路径是否设置正确
        $this->isConfigUploadPath();
    }

    /*
     * - 检查临时目录，正式目录是否设置，是否有权限
     * - 验证格式类型
     * - 验证图片大小
     * - 判断图片是否存在，存在则直接返回（判断方式-md5）
     * - 存储图片
     * - 根据日期设置文件名称
     * - 从临时目录转移到正式目录
     * - 返回图片URL
     */
    // public function check


    /**
     *
     * @throws UploadException
     */
    public function isConfigUploadPath()
    {
        if ('' == $this->uploadResourcesTmpPath) {
            throw new UploadException('请先设置临时存储路径');
        }
        if ('' == $this->uploadResourcesRealPath) {
            throw new UploadException('请先设置正式存储路径');
        }
    }


}