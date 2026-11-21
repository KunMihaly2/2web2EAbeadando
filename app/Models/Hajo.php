<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hajo extends Model
{
    protected $table = 'hajo';
    protected $primaryKey = 'az';
    public $timestamps = false;

    protected $fillable = ['nev', 'tipus', 'tulaz', 'uzemel'];

    protected $casts = [
        'uzemel' => 'boolean',
    ];

    public function tulajdonos(): BelongsTo
    {
        return $this->belongsTo(Tulajdonos::class, 'tulaz', 'az');
    }

    public function korabbiNevek(): HasMany
    {
        return $this->hasMany(KorabbiNev::class, 'hajoaz', 'az');
    }
}