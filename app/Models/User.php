<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'user_id',
        'google_id',
        'names',
        'surnames',
        'dni',
        'address',
        'email',
        'join_date',
        'last_login',
        'phone',
        'status',
        'role_name',
        'email',
        'avatar',
        'position',
        'department',
        'password',
        'user_type',
        'date_of_birth',
        'gender'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $getUser = self::orderBy('user_id', 'desc')->first();

            if ($getUser) {
                $latestID = intval(substr($getUser->user_id, 4));
                $nextID = $latestID + 1;
            } else {
                $nextID = 1;
            }
            $model->user_id = 'KH_' . sprintf("%04s", $nextID);
            while (self::where('user_id', $model->user_id)->exists()) {
                $nextID++;
                $model->user_id = 'KH_' . sprintf("%04s", $nextID);
            }
        });
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }

    public function sales()
{
    return $this->hasMany(EcommerceSaleProduct::class);
}

}
