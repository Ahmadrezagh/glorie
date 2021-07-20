<?php

namespace App\Repository;

use App\Http\Requests\Api\V1\VerifyCode\GenerateCodeRequest;
use App\Http\Requests\Api\V1\VerifyCode\VerifyCodeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface VerifyCodeRepositoryInterface
{
    public function generateCode(GenerateCodeRequest $request):JsonResponse;

    public function verifyCode(VerifyCodeRequest $request):JsonResponse;
}
