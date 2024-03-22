<?php

namespace App\Policies;

use App\Models\Bantuan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BantuanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bantuan $bantuan): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // 
    }

    public function edit(User $user, Bantuan $bantuan): bool
    {
        return $user->isRelawan();
    }

    public function update(User $user, Bantuan $bantuan): bool
    {
        return $user->isRelawan();
    }

    public function delete(User $user, Bantuan $bantuan): bool
    {
        return $bantuan->status === 'DITOLAK';
    }

    public function restore(User $user, Bantuan $bantuan): bool
    {
        //
    }

    public function forceDelete(User $user, Bantuan $bantuan): bool
    {
        //
    }
}
