<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserData;
use App\Models\UserRole;
use App\Models\SalarySlip;
use Laravel\Scout\Searchable;
use App\Models\AttendanceList;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function attendance_list(): HasMany
    {
        return $this->hasMany(AttendanceList::class);
    }

    public function makeAllSearchableUsing($query)
    {
        return $query->with(['user_data']);
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'nik' => $this->nik,
            'position' => $this->user_data->position->position,
        ];
    }

    public function user_data(): HasOne
    {
        return $this->hasOne(UserData::class);
    }

    public function user_role(): HasOne
    {
        return $this->hasOne(UserRole::class);
    }
}
