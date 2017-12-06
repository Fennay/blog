<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/12/4 - 18:33
 */

namespace App\Http\Controllers\Admin;

use App\Exceptions\UploadException;
use App\Services\UploadService;
use App\Traits\CommonResponse;
use Illuminate\Http\Request;

class PublicController extends BaseController
{
    use CommonResponse;

    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function upload(Request $request)
    {
        $type = $request->get('type');
        switch ($type) {
            case 'editor' :
                $filename = 'editormd-image-file';
                try {

                    $uploaded = $this->uploadService->upload($filename, [
                        'allowedMimeExtensions' => [
                            'png',
                            'jpeg',
                            'gif'
                        ],
                        'alsoAllowedMimeTypes'  => [
                            'application/vnd.ms-office',
                        ],
                        'maxFileSize'           => '20480',
                    ]);
                }catch(UploadException $exe){
                    return response()->json(['success' => 0, 'message' => $exe->getMessage()]);
                }

                return response()->json(['success' => 1, 'message' => '上传成功', 'url' => asset(env('RESOURCE_URL_PREFIX').$uploaded)]);
                break;
            default :
                $filename = 'file';
                $uploaded = $this->uploadService->upload($filename, [
                    'allowedMimeExtensions' => [
                        'png',
                        'jpeg',
                        'gif'
                    ],
                    'alsoAllowedMimeTypes'  => [
                        'application/vnd.ms-office',
                    ],
                    'maxFileSize'           => '20480',
                ]);

                return $this->ajaxSuccess('上传成功', ['img_url' => $uploaded]);
        }

    }
}