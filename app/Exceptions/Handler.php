<?php

namespace App\Exceptions;

use App\Traits\CommonResponse;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    use CommonResponse;
    /**
     * A list of the exception types that are not reported.
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception                $exception
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @author: Mikey
     */
    public function render($request, Exception $exception)
    {
        //if ($request->ajax()) {
        //    return $this->renderAjax($exception->errors());
        //} else {
        //    return response($exception->getMessage());
        //}

        return parent::render($request, $exception);
    }

    /**
     * 将验证异常转换成 JSON 响应
     * @param  \Illuminate\Http\Request                   $request
     * @param  \Illuminate\Validation\ValidationException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json($exception->errors(), $exception->status);
    }

    /**
     * 如果错误是数组，则只返回第一个
     * @param $error
     * @return \Illuminate\Http\JsonResponse
     * @author: Mikey
     */
    protected function renderAjax($error)
    {
        if (is_array($error)) {
            $error = current($error)[0];
        }

        return $this->ajaxError($error);
    }
}
