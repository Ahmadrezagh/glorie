<?php
    namespace App\Services\Auth;
    use App\Http\Requests\Api\V1\VerifyCode\VerifyCodeRequest;
    use App\Http\Resources\Auth\UserResource;
    use App\Interfaces\AuthInterface;
    use App\Repository\Eloquent\UserRepository;
    use App\Repository\UserRepositoryInterface;
    use App\Repository\VerifyCodeRepositoryInterface;
    use Illuminate\Http\Request;
    use Illuminate\Http\JsonResponse;

    class JwtService implements AuthInterface
    {
        private $verifyCode;
        private $userRepository;
        public function __construct(VerifyCodeRepositoryInterface $verifyCode,UserRepositoryInterface $userRepository)
        {
            $this->verifyCode = $verifyCode;
            $this->userRepository = $userRepository;
        }

        public function login(Request $request):JsonResponse
        {
            $credentials = request(['email', 'password']);
            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return $this->respondWithToken($token);
        }

        public function loginBySMS(VerifyCodeRequest $request)
        {
            $verify = $this->verifyCode->verifyCode($request);
            $v = json_decode(json_encode($verify),true);
            $verified = $v['original']['verified'];
            if($verified)
            {
                $user = $this->userRepository->findUserByPhone($request->phone);
                if(!$user)
                {
                   $user = $this->userRepository->createUserByPhone($request->phone);
                }
                $credentials = request(['phone']);
                if (! $token = auth('api')->login($user)) {
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
                return $this->respondWithToken($token);
            }
            return $verify;
        }

        public function me():JsonResponse
        {
            return response()->json(new UserResource(auth('api')->user()));
        }

        public function logout():JsonResponse
        {
            auth()->logout();

            return response()->json(['message' => 'Successfully logged out']);
        }

        public function refresh():JsonResponse
        {
            return $this->respondWithToken(auth('api')->refresh());
        }

        /**
         * Get the token array structure.
         *
         * @param  string $token
         *
         * @return JsonResponse
         */
        protected function respondWithToken($token):JsonResponse
        {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        }

    }
