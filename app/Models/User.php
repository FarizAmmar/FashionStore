<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'username',
    //     'email',
    //     'password',
    //     'position_id',
    //     'level_id',
    //     'salary_id',
    // ];

    protected $guarded = [
        'id'
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

    // Foreign Key Level
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    // Foreign Key Position
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    // Foreign Key Salary
    public function Salary()
    {
        return $this->belongsTo(Salary::class);
    }

    // Scope / Search
    public function scopeFilter($query, array $fillters)
    {
        // Search All
        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%');
        });

        // Search by Name and Username
        $query->when($fillters['name'] ?? false, function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%')
                ->orWhere('username', 'like', '%' . $name . '%');
        });

        // Search by Position
        $query->when($fillters['position'] ?? false, function ($query, $position) {
            return $query->whereHas('position', function ($query) use ($position) {
                $query->where('name', $position);
            });
        });

        // Search by Level
        $query->when($fillters['access'] ?? false, function ($query, $access) {
            return $query->whereHas('level', function ($query) use ($access) {
                $query->where('name', $access);
            });
        });
    }
}
