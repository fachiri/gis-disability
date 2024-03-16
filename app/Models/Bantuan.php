<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

class Bantuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penyandang_id',
        'relawan_id',
        'status',
        'jenis',
        'detail',
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

    public function penyandang(): BelongsTo
    {
        return $this->belongsTo(Penyandang::class);
    }
}
