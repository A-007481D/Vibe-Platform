<?php

namespace App\Services;

use App\Models\User;

class UserSearchService
{
    public function searchUsers($search)
    {
        return User::where('username', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->get();
    }
}
