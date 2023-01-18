<?php

namespace App\Validators\Auth;

use App\Models\User;

class Base extends \App\Validators\Base\BaseValidator
{
    public function checkEmailOnExists(string $email): bool|User
    {
        return User::findBy('email', $email);
    }
}