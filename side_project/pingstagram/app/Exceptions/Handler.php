<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function report(Throwable $th) {
        // Log::info($th->getMessage());
        $code = 'E99';

        if($th instanceof AuthenticationException) {
            $code = $th->getMessage();
        }
        $errInfo = $this->context()[$code];

        Log::info($code.' : '.$errInfo['msg']);
    }

    // 에러메시지
    public function context() {
        return [
            'E01' => ['status' => 401, 'msg' => '인증 실패'],
            'E99' => ['status' => 500, 'msg' => '시스템 에러 발생'],
        ];
    }

    public function render($request, Throwable $th) {
        $code = 'E99';

        if($th instanceof AuthenticationException) {
            $code = $th->getMessage();
        }

        $errInfo = $this->context()['$code'];

        $responseData = [
            'success' => false
            ,'code' => $code
            ,'msg' => $errInfo['msg']
        ];

        return response()->json($responseData, $errInfo['status']);
    }
}
