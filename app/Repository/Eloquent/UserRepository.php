<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use http\Env\Request;
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
}
