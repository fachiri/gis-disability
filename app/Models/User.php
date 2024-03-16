<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Constants\UserRole;
use App\Utils\AuthUtils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'birthday',
        'gender',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();
        self::saving(function ($model) {
            if (!$model->exists) {
                $model->uuid = (string) Uuid::uuid4();
            }
            $model->phone = str_replace('-', '', $model->phone);
        });
    }

    public function isAdmin(): bool
    {
        return AuthUtils::getRole($this) === UserRole::ADMIN;
    }

    public function isManager(): bool
    {
        return AuthUtils::getRole($this) === UserRole::MANAGER;
    }

    public function isRelawan(): bool
    {
        return AuthUtils::getRole($this) === UserRole::RELAWAN;
    }

    public function relawan(): HasOne
    {
        return $this->hasOne(Relawan::class);
    }

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }

    public function manager(): HasOne
    {
        return $this->hasOne(Manager::class);
    }
}
