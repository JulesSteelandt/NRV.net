<?php

namespace nrv\auth\app\auth\providers;

use DateTime;
use DateTimeZone;
use Exception;
use nrv\auth\app\auth\managers\JwtManager;
use nrv\auth\domain\dto\CredentialsDTO;
use nrv\auth\domain\dto\TokenDTO;
use nrv\auth\domain\entities\Utilisateur;
use nrv\auth\domain\exception\CredentialsException;
use nrv\auth\domain\exception\RefreshTokenInvalideException;
use nrv\auth\domain\exception\RefreshUtilisateurException;
use nrv\auth\domain\exception\RegisterException;
use nrv\auth\domain\exception\RegisterExistException;
use nrv\auth\domain\exception\RegisterValueException;
use nrv\auth\domain\exception\SignInException;

class AuthProvider {


    protected Utilisateur $currentAuthenticatedUser;

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



    public function getAuthenticatedUser(): array
    {
        return [
            'typeUtiltypeUtil' => $this->currentAuthenticatedUser->typeUtil,
            'email' => $this->currentAuthenticatedUser->email,
            'nom' => $this->currentAuthenticatedUser->nom,
            'prenom' => $this->currentAuthenticatedUser->prenom,
            'refresh_token' => $this->currentAuthenticatedUser->refresh_token,
        ];
    }


    public function checkToken(string $token)
    {
        try {
            $user = Utilisateur::where('refresh_token', $token)->firstOrFail();
            $tokenExpDate = new DateTime($user->refresh_token_expiration_date);
            $now = new DateTime('now', new DateTimeZone('Europe/Paris'));

            if ($tokenExpDate->getTimestamp() < $now->getTimestamp()) {
                throw new RefreshTokenInvalideException();
            }
        } catch (Exception $e) {
            throw new RefreshTokenInvalideException();
        }
    }

    public function genToken(Utilisateur $user, JwtManager $jwtManager): TokenDTO
    {
        $newRefreshToken = bin2hex(random_bytes(32));
        $now = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $refreshTokenExpDate = $now->modify('+1 hour');

        $user->refresh_token = $newRefreshToken;
        $user->refresh_token_expiration_date = $refreshTokenExpDate->format('Y-m-d H:i:s');
        $user->save();

        $token = $jwtManager->create(['username' => $user->username, 'email' => $user->email]);
        return new TokenDTO($newRefreshToken, $token);
    }

    public function getUser(string $email, string $token): Utilisateur
    {
        if ($email == '') {
            try {
                return Utilisateur::where('refresh_token', $token)->firstOrFail();
            } catch (Exception $e) {
                throw new RefreshUtilisateurException();
            }
        } else {
            try {
                return Utilisateur::where('email', $email)->firstOrFail();
            } catch (Exception $e) {
                throw new SignInException();
            }
        }

    }

    public function register(CredentialsDTO $user): void
    {
        if(Utilisateur::where('email', $user->email)->exists()) {
            throw new RegisterExistException();
        }
        if($user->email == '' || $user->password == '' || $user->nom == '' || $user->prenom == ''){
            throw new RegisterValueException();}
        else {
            $utilisateur = new Utilisateur();
            $utilisateur->email = $user->email;
            $utilisateur->password = password_hash($user->password, PASSWORD_BCRYPT);
            $utilisateur->nom = $user->nom;
            $utilisateur->prenom = $user->prenom;
            $utilisateur->typeUtil = 1;
            $utilisateur->save();
        }
    }




}

