<?php

namespace App\Repositories\EloquentImpl;

use App\Repositories\UserRepository;

class UserRepositoryImpl extends Repository implements UserRepository
{
    public function __construct(private User $user)
    {
        parent::__construct($user);
    }
}
