<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UpdateProfileRequest;
use App\Http\Requests\Api\V1\User\UpdateReferralCodeRequest;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $user;
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        return $this->user->updateProfile($request);
    }

    public function updateReferralCode(UpdateReferralCodeRequest $request)
    {
        return $this->user->updateReferralCode($request);
    }
}
