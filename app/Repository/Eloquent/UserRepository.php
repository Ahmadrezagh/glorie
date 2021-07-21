<?php

namespace App\Repository\Eloquent;

use App\Http\Requests\Api\V1\User\UpdateProfileRequest;
use App\Http\Requests\Api\V1\User\UpdateReferralCodeRequest;
use App\Http\Resources\Api\V1\Errors\UnauthorizedResource;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    public function findUserByPhone($phone)
    {
        return $this->model->newQuery()->wherePhone($phone)->first();
    }

    public function createUserByPhone($phone)
    {
        $user = $this->model->newQuery()->create([
            'phone' => $phone,
            'referral_code' => rand(1000,9999)
        ]);
        return $user;
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
       if(auth('api')->check())
       {
           $this->model->newQuery()->find( auth('api')->user()->id)->update($request->validated());
           if($request->file('profile'))
           {
               $profile = uploadFile($request->file('profile'),'/profiles',auth('api')->user()->id);
               $this->model->newQuery()->findOrFail( auth('api')->user()->id)->update([
                   'profile' => $profile
               ]);
           }
           return response()->json([
               'error' => 'پروفایل با موفقیت ویرایش شد'
           ],200);
       }
        return response()->json(new UnauthorizedResource($request), 401);
    }

    public function updateReferralCode(UpdateReferralCodeRequest $request)
    {
        if(auth('api')->check()) {
            $user = $this->model->newQuery()->find(auth('api')->user()->id);
            if($user->referred_code == null)
            {
                if($this->model->newQuery()
                    ->where('referral_code','=',$request->referral_code)
                    ->where('id','!=',auth('api')->user()->id)
                    ->first()
                ){
                    $user->update([
                        'referred_code' => $request->referral_code
                    ]);
                    return response()->json([
                        'message' => 'کد معرف با موفقیت برای شما ثبت شد'
                    ],200);
                }
                return response()->json([
                    'error' => 'کد معرف نامعتبر می باشد'
                ],422);
            }
            return response()->json([
                'error' => 'شما از کد معرف استفاده کرده اید'
            ],422);
        }
        return response()->json(new UnauthorizedResource($request), 401);
    }
}
