<?php
    namespace App\Repository\Eloquent;
    use App\Http\Requests\Api\V1\VerifyCode\GenerateCodeRequest;
    use App\Http\Requests\Api\V1\VerifyCode\VerifyCodeRequest;
    use App\Http\Resources\Api\V1\VerifyCode\GenerateCodeResource;
    use App\Interfaces\SmsInterface;
    use App\Models\VerifyCode;
    use App\Repository\VerifyCodeRepositoryInterface;
    use Carbon\Carbon;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;

    class VerifyCodeRepository extends BaseRepository implements VerifyCodeRepositoryInterface
    {
        private $sms;
        /**
         * UserRepository constructor.
         *
         * @param VerifyCode $model
         */
        public function __construct(VerifyCode $model,SmsInterface $sms)
        {
            parent::__construct($model);
            $this->sms = $sms;
        }

        public function generateCode(GenerateCodeRequest $request):JsonResponse
        {
            $verify = $this->model->create($request->validated());
            $this->sms->send($request->phone,$verify->code);
            return response()->json(GenerateCodeResource::make($request));
        }

        public function verifyCode(VerifyCodeRequest $request):JsonResponse
        {
            $status = 'failed';
            $verified = false;
            $reason = '';
            $verify = $this->model->newQuery()->wherePhone($request->phone)->latest()->first();
            if($verify)
            {
                if($verify->code == $request->code)
                {
                    if(strtotime($verify->expire_at) >= strtotime(Carbon::now())){
                        $verified = true;
                        $status = 'success';
                        $reason = 'احراز هویت موفقیت آمیز بود';
                    }else{
                        $reason = 'کد منقضی شده است';
                    }
                }else{
                    $reason = 'کد اشتباه است';
                }
            }else{
                $reason = 'شماره وارد شده نامعتبر است';
            }
            return response()->json([
                'status' => $status,
                'verified' => $verified,
                'message' => $reason
            ]);
        }
    }
