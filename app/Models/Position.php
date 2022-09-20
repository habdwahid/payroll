<?php

namespace App\Models;

use App\Models\Salary;
use App\Models\UserData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Position extends Model
{
    use HasFactory, Searchable;

    /**
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function salary(): HasOne
    {
        return $this->hasOne(Salary::class);
    }

    public function toSearchableArray()
    {
        return [
            'position' => $this->position,
        ];
    }

    public function user_data(): HasOne
    {
        return $this->hasOne(UserData::class);
    }
}
