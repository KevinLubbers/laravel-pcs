<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Illuminate\Support\Facades\Gate;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        if (Gate::denies('make-changes')) {
            session()->flash('error', 'Demo users cannot make changes.');
            return;
        }
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
