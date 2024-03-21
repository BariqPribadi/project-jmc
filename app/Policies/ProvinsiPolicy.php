<?php

namespace App\Policies;

use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProvinsiPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Provinsi $provinsi)
    {
        return $user->id === $provinsi->user_id; // atau menggunakan role atau hak akses lainnya sesuai kebutuhan Anda
    }

    /**
     * Determine whether the user can delete the model.
     */

}
