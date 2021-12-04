<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UuidModelTrait;

class VaultData extends Model
{
    use HasFactory, UuidModelTrait;

    /**
     * Relation with Vault.
     */
    public function vault()
    {
        return $this->belongsTo(Vault::class);
    }
}
