<?php

namespace App\Repositories\Account;

use App\Models\Account;
use App\Repositories\BaseRepository;
use App\Repositories\Account\AccountRepositoryInterface;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\User::class;
    }
}
