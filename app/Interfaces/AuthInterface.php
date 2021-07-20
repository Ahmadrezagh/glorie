<?php
    namespace App\Interfaces;
    use App\Http\Requests\Api\V1\VerifyCode\VerifyCodeRequest;
    use App\Http\Resources\Auth\UserResource;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;

    interface AuthInterface{
        public function login(Request $request):JsonResponse;

        public function me():JsonResponse;

        public function logout():JsonResponse;

        public function refresh():JsonResponse;

        public function loginBySMS(VerifyCodeRequest $request);
    }
