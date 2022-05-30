<?php
namespace App\Auth;

use App\Exceptions\Auth\InactiveUserException;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserProvider extends EloquentUserProvider
{
    /**
     * Returns a boolean indicating whether the given email address is already
     * in use.
     *
     * @param string $email
     * @return bool
     */
    public function emailInUse(string $email): bool
    {
        return $this->newModelQuery()->where('email', $email)->exists();
    }

    /**
     * Creates, saves, and returns a new user flagged as an administrator.
     *
     * @param string $email
     * @param string $password
     * @param array<string, string> $otherProperties
     * @return Illuminate\Foundation\Auth\User
     */
    public function createAdministrator(
        string $email,
        string $password,
        ?array $otherProperties = []
    ): User
    {
        $user = $this->createModel();
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->is_administrator = true;
        foreach ($otherProperties as $prop => $val) {
            $user->$prop = $val;
        }
        $user->save();
        return $user;
    }

    /**
     * Given an email address, retrieves the corresponding user and sets its
     * status as inactive.
     *
     * @param string $email
     * @return void
     */
    public function deactivate(string $email)
    {
        $user = $this->newModelQuery()->where('email', $email)->firstOrFail();
        if (!$user->is_active) {
            throw new InactiveUserException(
                'The user "'.$email.'" has already been deactivated.'
            );
        }
        $user->is_active = false;
        $user->save();
    }
}
