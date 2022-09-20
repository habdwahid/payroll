<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserRole;

class UserRoleObserver
{
    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $user->forceDeleted(function ($user) {
            UserRole::where('user_id', $user->id)
                ->delete();
        });
    }
}
