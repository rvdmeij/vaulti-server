<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vault extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'hash'
    ];

    /**
     * Set UUID upon vault creation.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::generate()->string;
        });
    }

    /**
     * Relation with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation with VaultData.
     */
    public function data()
    {
        return $this->hasOne(VaultData::class);
    }
}
