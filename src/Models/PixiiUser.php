<?php

namespace PixiiBomb\Essentials\Models;

use App\Models\User;

class PixiiUser extends User
{
    protected $table = USERS;

    protected $fillable = [
        'username',
        'email',
        'password'
    ];
}
