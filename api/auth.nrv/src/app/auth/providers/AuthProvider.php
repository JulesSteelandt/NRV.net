<?php

namespace nrv\auth\app\auth\providers;

use Exception;
use nrv\auth\domain\entities\Utilisateur;
use nrv\auth\domain\exception\CredentialsException;

class AuthProvider {


    private Utilisateur $currentAuthenticatedUser;

    public function checkCredentials(string $email, string $pass): void
    {
        try {
            $user = Utilisateur::where('email', $email)->firstOrFail();

            if (!password_verify($pass, $user->password)) {
                throw new CredentialsException();
            }
        } catch (Exception $e) {
            throw new CredentialsException();
        }
    }
}