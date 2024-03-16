<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'relawan_id',
        'name',
        'location',
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

    public function relawan(): BelongsTo
    {
        return $this->belongsTo(Relawan::class);
    }

    public function documentations(): HasMany
    {
        return $this->hasMany(Documentation::class);
    }
}
