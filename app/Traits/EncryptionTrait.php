<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait EncryptionTrait {

    /**
     * Encrypt data string.
     * 
     * @param string $data
     * 
     * @return string
     */
    public function encrypt(string $data): string {
        return Crypt::encryptString($data);
    }

    /**
     * Decrypt encrypted string.
     * 
     * @param string $data
     * 
     * @return string
     */
    public function decrypt(string $data): string {
        return Crypt::decryptString($data);
    }

}