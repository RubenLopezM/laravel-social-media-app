<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\RegisteredUser;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $user->notify(new RegisteredUser());
    }
}
