<?php

namespace App\Observers;

use App\Models\Position;
use App\Models\Salary;

class SalaryObserver
{
    /**
     * Handle the Position "created" event.
     *
     * @param  \App\Models\Position  $position
     * @return void
     */
    public function created(Position $position)
    {
        Salary::create([
            'position_id' => $position->id,
        ]);
    }

    /**
     * Handle the Position "deleted" event.
     *
     * @param  \App\Models\Position  $position
     * @return void
     */
    public function deleted(Position $position)
    {
        Salary::where('position_id', $position->id)
            ->delete();
    }
}
