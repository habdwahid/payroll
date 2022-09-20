<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserData;

class UserDataObserver
{
    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        UserData::where('user_id', $user->id)
            ->delete();
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        UserData::where('user_id', $user->id)
            ->restore();
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        UserData::where('user_id', $user->id)
            ->forceDelete();
    }
}
