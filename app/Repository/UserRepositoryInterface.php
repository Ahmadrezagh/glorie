<?php
namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;

    public function findUserByPhone($phone);

    public function createUserByPhone($phone);
}
