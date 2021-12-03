<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaultData extends Model
{
    use HasFactory;

    /**
     * Set UUID upon VaultData creation.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::generate()->string;
        });
    }

    /**
     * Relation with Vault.
     */
    public function vault()
    {
        return $this->belongsTo(Vault::class);
    }
}
