<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModelTrait;

class VaultData extends Model
{
    use HasFactory, UuidModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'data', 'vault_id'
    ];


    /**
     * Relation with Vault.
     */
    public function vault()
    {
        return $this->belongsTo(Vault::class);
    }

    /**
     * Set data field.
     */
    public function setData(string $data = NULL) {
        $this->data = $data;
        return $this;
    }
}
