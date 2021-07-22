<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\SendSmsRequest;
use App\Http\Requests\Api\V1\User\UpdateProfileRequest;
use App\Http\Requests\Api\V1\VerifyCode\generateCodeRequest;
use App\Http\Requests\Api\V1\VerifyCode\VerifyCodeRequest;
use App\Interfaces\AuthInterface;
use App\Interfaces\SmsInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\VerifyCodeRepositoryInterface;
use App\Services\Sms\KaveNegarSms;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $verifyCode;
    private $auth;
    private $user;
    public function __construct(VerifyCodeRepositoryInterface $verifyCode, AuthInterface $auth,UserRepositoryInterface $user)
    {
        $this->verifyCode = $verifyCode;
        $this->auth = $auth;
        $this->user = $user;
    }

    public function generateCode(GenerateCodeRequest $request)
    {
        return $this->verifyCode->generateCode($request);
    }

    public function loginBySMS(VerifyCodeRequest $request)
    {
        return $this->auth->loginBySMS($request);
    }

    public function me()
    {
        return $this->auth->me();
    }


}
