<?php

namespace App\Exceptions;

use App\Traits\CommonResponse;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

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
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception                $e
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @author: Mikey
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof HomeException || $e instanceof BusinessException) {
            return $this->renderShowableException($request, $e);
        } elseif (
            $e instanceof HomeException
        ) {
            return HomeException::homeRender($request, $e);
        }


        return parent::render($request, $e);
    }

    /**
     * 将验证异常转换成 JSON 响应 多个错误信息，取第一个
     * @param  \Illuminate\Http\Request                   $request
     * @param  \Illuminate\Validation\ValidationException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {
        return $this->ajaxError(current($exception->errors()));
    }

    /**
     * 可以显示给用户的错误信息
     * 支持AJAX JSON返回
     * @param           $request
     * @param Exception $e
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @author: Mikey
     */
    protected function renderShowableException($request, Exception $e)
    {
        if ($request->ajax()) {
            return $this->ajaxError($e->getMessage());
        } else {
            return response($e->getMessage());
        }
    }
}
