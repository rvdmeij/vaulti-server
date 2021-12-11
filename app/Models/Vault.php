<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModelTrait;

class Vault extends Model
{
    use HasFactory, UuidModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'hash', 'user_id'
    ];

    /**
     * Visible fields.
     */
    protected $visible = [
        'id', 'hash', 'name', 'created_at', 'updated_at'
    ];

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
