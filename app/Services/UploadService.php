<?php
/**
 * Created by PhpStorm.
 * User: Mikey
 * Date: 2017/12/4
 * Time: 22:02
 */

namespace App\Services;

use App\Exceptions\UploadException;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;

class UploadService
{
    protected $request;
    protected $resourceRelativePath;
    protected $tmpUploadResourcesPath;
    protected $realUploadResourcesPath;

    protected $defaultOption = [
        'allowedMimeExtensions' => [],
        'alsoAllowedMimeTypes'  => [],
        'maxFileSize'           => 20480, // 此处单位为KB
    ];

    public function __construct(
        Request $request,
        $resourceRelativePath,
        $tmpUploadResourcesPath,
        $realUploadResourcesPath
    )
    {
        $this->request = $request;
        $this->resourceRelativePath = $resourceRelativePath;
        $this->tmpUploadResourcesPath = $tmpUploadResourcesPath;
        $this->realUploadResourcesPath = $realUploadResourcesPath;

        // 检查存储路径是否设置正确
        $this->isConfigUploadPath();
    }

    /**
     * @throws UploadException
     */
    protected function isConfigUploadPath()
    {
        if ('' == $this->tmpUploadResourcesPath) {
            throw new UploadException('请先设置临时存储路径');
        }
        if ('' == $this->realUploadResourcesPath) {
            throw new UploadException('请先设置正式存储路径');
        }
    }

    public function upload($filename = 'file', array $option = [])
    {
        $options = array_merge($this->defaultOption, $option);
        $file = $this->request->file($filename);

        // 如果上传失败
        if (!$file->isValid()) {
            throw new UploadException($file->getErrorMessage());
        }
        // 验证文件格式是否正确
        $this->isAllowFileType($filename, $options);
        // 验证文件大小
        $this->isAllowMaxSize($filename, $options);
        // 得到临时目录
        $tmpUploadDirPath = $this->makeFilePathWithDate($this->tmpUploadResourcesPath);

        // 存储
        return $this->saveFile($file, $tmpUploadDirPath);
    }

    /**
     * 保存到真是地址
     * @param $fileRelativePath
     * @return mixed
     * @throws UploadException
     * @author: Mikey
     */
    public function uploadSave($fileRelativePath)
    {
        if ($this->isInTemp($fileRelativePath)) {
            $tempFileFullPath = $this->getFullPathFormRelative($fileRelativePath);

            if (!File::exists($tempFileFullPath)) {
                throw new UploadException('临时上传的文件不存在！' . $fileRelativePath . '[' . $tempFileFullPath . ']');
            }

            $realUploadResourcesPath = $this->makeFilePathWithDate($this->realUploadResourcesPath);
            $filename = $this->getRandomFileName(File::extension($tempFileFullPath));
            $toFilePath = $this->makeDirectoryIfNotExists($realUploadResourcesPath) . DIRECTORY_SEPARATOR . $filename;

            File::copy($tempFileFullPath, $toFilePath);

            return $realUploadResourcesPath . DIRECTORY_SEPARATOR . $filename;
        }

        return $fileRelativePath;
    }

    /**
     * 判断文件是否存在，且在临时目录中
     * @param $fileRelativePath
     * @return bool
     * @author: Mikey
     */
    protected function isInTemp($fileRelativePath)
    {
        $fullPath = $this->getFullPathFormRelative($fileRelativePath);
        // 临时存储目录
        $tmpUploadResourcesFullPath = $this->getFullPathFormRelative(
            $this->makeFilePathWithDate($this->tmpUploadResourcesPath)
        );
        //如果文件路径和临时文件夹路径一致，并且文件存在
        if (0 == substr_compare($fullPath, $tmpUploadResourcesFullPath, 0, mb_strlen($tmpUploadResourcesFullPath))) {
            return true;
        }

        return false;
    }

    /**
     * 验证格式
     * @param       $filename
     * @param array $options
     * @throws UploadException
     * @author: Mikey
     */
    protected function isAllowFileType($filename, array $options)
    {
        $mimeExtensions = $options['allowedMimeExtensions'];
        $extraMimeTypes = $options['alsoAllowedMimeTypes'];

        $toBeValidated = $this->request->only($filename);

        $rules   = [];
        $rules[] = 'required';
        $rules[] = 'mimes:' . implode(',', $mimeExtensions);

        $validator = Validator::make($toBeValidated, [
            $filename => $rules,
        ]);
        if ($validator->fails()) {
            if (empty($extraMimeTypes)) {
                throw new UploadException($validator->messages()->first());
            }

            $fileMimeType = $this->request->file($filename)->getMimeType();
            if ( ! in_array($fileMimeType, $extraMimeTypes)) {
                throw new UploadException('上传文件格式错误');
            }
        }
    }

    /**
     * 验证是否超过最大限制
     * @param       $filename
     * @param array $options
     * @throws UploadException
     * @author: Mikey
     */
    protected function isAllowMaxSize($filename, array $options)
    {
        $file = $this->request->only($filename);
        $validator = Validator::make($file, [
            $filename => [
                'required',
                'max:' . $options['maxFileSize']
            ]
        ]);
        if ($validator->fails()) {
            throw new UploadException($validator->messages()->first());
        }
    }

    /**
     * 保存文件
     * @param UploadedFile $file
     * @param              $tmpUploadDirPath
     * @return string
     * @author: Mikey
     */
    protected function saveFile(UploadedFile $file, $tmpUploadDirPath)
    {
        // 获取文件扩展名
        $fileExtensions = $file->getClientOriginalExtension();
        // 拼接生成新的文件名
        $saveFileName = $this->getRandomFileName($fileExtensions);

        $file->move($this->makeDirectoryIfNotExists($tmpUploadDirPath), $saveFileName);

        return $tmpUploadDirPath . DIRECTORY_SEPARATOR . $saveFileName;
    }

    /**
     * 加一层日期目录
     * @param $uploadDirPath
     * @return string
     * @author: Mikey
     */
    protected function makeFilePathWithDate($uploadDirPath)
    {
        $date = date('Ymd');

        return $uploadDirPath . $date;
    }

    /**
     * 随机生成文件名称
     * @param $fileExtensions
     * @return string
     * @author: Mikey
     */
    protected function getRandomFileName($fileExtensions)
    {
        $fileExtensions = $fileExtensions ? ('.' . $fileExtensions) : '';

        return Str::random(15) . $fileExtensions;
    }

    /**
     * 如果目录不存在，则递归创建目录
     * @param $directoryPath
     * @return string
     * @author: Mikey
     */
    protected function makeDirectoryIfNotExists($directoryPath)
    {
        $fullPath = $this->getFullPathFormRelative($directoryPath);
        if (!File::exists($fullPath) || !File::isDirectory($fullPath)) {
            File::makeDirectory($fullPath, 493, true);
        }

        return $fullPath;
    }

    /**
     * 获取完整路径，相对路径转绝对路径
     * @param $relativePath
     * @return string
     * @author: Mikey
     */
    protected function getFullPathFormRelative($relativePath)
    {
        return base_path($this->resourceRelativePath . $relativePath);
    }
}