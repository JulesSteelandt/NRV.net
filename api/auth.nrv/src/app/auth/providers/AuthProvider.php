<?php

namespace nrv\auth\app\auth\providers;

use DateTime;
use DateTimeZone;
use Exception;
use nrv\auth\app\auth\managers\JwtManager;
use nrv\auth\domain\dto\TokenDTO;
use nrv\auth\domain\entities\Utilisateur;
use nrv\auth\domain\exception\CredentialsException;
use nrv\auth\domain\exception\RefreshTokenInvalideException;
use nrv\auth\domain\exception\RefreshUtilisateurException;
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

        $token = $jwtManager->create(['email' => $user->email, 'nom' => $user->nom, 'prenom' => $user->prenom, 'typeUtil' => $user->typeUtil ]);
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

    public function register(string $email, string $password, string $nom, string $prenom): void
    {
        if(Utilisateur::where('email', $email)->exists()) {
            throw new RegisterExistException();
        }
        if($email == '' || $password == '' || $nom == '' || $prenom == ''){
            throw new RegisterValueException();}
        else {
            $now = new DateTime('now', new DateTimeZone('Europe/Paris'));
            $refreshTokenExpDate = $now->modify('+1 hour');

            $utilisateur = new Utilisateur();
            $utilisateur->email = $email;
            $utilisateur->password = password_hash($password, PASSWORD_BCRYPT);
            $utilisateur->nom = $nom;
            $utilisateur->prenom = $prenom;
            $utilisateur->typeUtil = 1;
            $utilisateur->refresh_token = bin2hex(random_bytes(32));
            $utilisateur->refresh_token_expiration_date = $refreshTokenExpDate->format('Y-m-d H:i:s');
            $utilisateur->save();
        }
    }




}

