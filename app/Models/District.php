<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
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
        });
    }

    public function relawan(): HasMany
    {
        return $this->hasMany(Relawan::class);
    }

    public function penyandang(): HasMany
    {
        return $this->hasMany(Penyandang::class);
    }
}
