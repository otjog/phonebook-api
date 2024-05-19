<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContactPolicy
{
    public function viewAny(User $user): Response
    {
        return $user->hasVerifiedEmail()
            ? Response::allow()
            : Response::deny('Вам нужно подтвердить email.', '403');
    }

    public function create(User $user): Response
    {
        return $user->hasVerifiedEmail()
            ? Response::allow()
            : Response::deny('Вам нужно подтвердить email.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Contact $contact): Response
    {
        if ($user->id !== $contact->user_id)
            return Response::deny('Этот пост не принадлежит вам');
        if (!$user->hasVerifiedEmail())
            return Response::deny('Вам нужно подтвердить email.');
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contact $contact): Response
    {
        if ($user->id !== $contact->user_id)
            return Response::deny('Этот пост не принадлежит вам');
        if (!$user->hasVerifiedEmail())
            return Response::deny('Вам нужно подтвердить email.');
        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Contact $contact): Response
    {
        if ($user->id !== $contact->user_id)
            return Response::deny('Этот пост не принадлежит вам');
        if (!$user->hasVerifiedEmail())
            return Response::deny('Вам нужно подтвердить email.');
        return Response::allow();
    }
}
