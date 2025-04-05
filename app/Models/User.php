<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar', // Add this line
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'last_login_at' => 'datetime',
            'password' => 'hashed',

        ];
    }

    public static function getActiveUsersStats()
    {
        $activeToday = self::where('last_login_at', '>=', now()->subDay())->count();
        $activeYesterday = self::whereBetween('last_login_at', [
            now()->subDays(2),
            now()->subDay()
        ])->count();

        $percentageChange = 0;
        if ($activeYesterday > 0) {
            $percentageChange = (($activeToday - $activeYesterday) / $activeYesterday) * 100;
        }

        return [
            'count' => $activeToday,
            'percentage_change' => $percentageChange,
            'trend' => $percentageChange >= 0 ? 'up' : 'down'
        ];
    }

    public function getLastLoginAtAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value) : null;
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function getAvatarUrl()
    {
        if ($this->avatar) {
            return asset('images/' . $this->avatar);
        }
        return null;
    }
}
