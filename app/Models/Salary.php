<?php

namespace App\Models;

use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Salary extends Model
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

    public function makeAllSearchableUsing($query)
    {
        return $query->with(['position']);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function toSearchableArray()
    {
        return [
            'position' => $this->position->position,
            'salary' => $this->salary,
        ];
    }
}
