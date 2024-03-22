<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Penyandang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_induk_disabilitas',
        'nik',
        'no_kk',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'status_pernikahan',
        'keterampilan',
        'usaha',
        'kontak',
        'alamat',
        'latitude',
        'longitude',
        'jenis_disabilitas',
        'keterangan_meninggal',
        'keterangan_sembuh',
        'foto_diri',
        'foto_ktp',
        'foto_kk',
        'district_id',
        'relawan_id',
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
            $model->kontak = str_replace('-', '', $model->kontak);
        });
    }

    public function bantuan(): HasMany
    {
        return $this->hasMany(Bantuan::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function relawan(): BelongsTo
    {
        return $this->belongsTo(Relawan::class);
    }
}
