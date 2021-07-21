<?php
namespace App\Repository;

use App\Http\Requests\Api\V1\User\UpdateProfileRequest;
use App\Http\Requests\Api\V1\User\UpdateReferralCodeRequest;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;

    public function findUserByPhone($phone);

    public function createUserByPhone($phone);

    public function updateProfile(UpdateProfileRequest $request);

    public function updateReferralCode(UpdateReferralCodeRequest $request);
}
