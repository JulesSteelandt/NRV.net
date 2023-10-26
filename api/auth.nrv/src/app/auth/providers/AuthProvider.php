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
use Psr\Log\LoggerInterface;

class AuthProvider {

    private LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }


    public function checkCredentials(string $email, string $pass): void {
        try {
            $user = Utilisateur::where('email', $email)->firstOrFail();
            if (!password_verify($pass, $user->mdp)) {
                $this->logger->error('Error : Le mot de passe n\'a pas passe la verification');
                throw new CredentialsException();
            }
        } catch (Exception $e) {
            $this->logger->error('Error : L\'email n\'a pas de compte associe');
            throw new CredentialsException();
        }
    }


    public function getAuthenticatedUser(string $email): array {
        $user = Utilisateur::where('email', $email)->firstOrFail();
        $info = [
            'typeUtil' => $user->typeUtil,
            'email' => $user->email,
            'nom' => $user->nom,
            'prenom' => $user->prenom,
            'refresh_token' => '',
        ];
        if (isset($user->refresh_token)) {
            $info['refresh_token'] = $user->refresh_token;
        }
        return $info;
    }


    public function checkToken(string $token) {
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

    public function genToken(Utilisateur $user, JwtManager $jwtManager): TokenDTO {
        $newRefreshToken = bin2hex(random_bytes(32));
        $now = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $refreshTokenExpDate = $now->modify('+1 hour');

        $user->refresh_token = $newRefreshToken;
        $user->refresh_token_expiration_date = $refreshTokenExpDate->format('Y-m-d H:i:s');
        $user->save();

        $token = $jwtManager->create(['email' => $user->email, 'nom' => $user->nom, 'prenom' => $user->prenom, 'typeUtil' => $user->typeUtil]);
        return new TokenDTO($newRefreshToken, $token);
    }

    public function getUser(string $email, string $token): Utilisateur {
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

    public function register(string $email, string $mdp, string $nom, string $prenom): void {
        if (Utilisateur::where('email', $email)->exists()) {
            $this->logger->error('Erreur : impossible de creer le compte, l\'email est deja utilisée');
            throw new RegisterExistException();
        }
        if ($email == '' || $mdp == '' || $nom == '' || $prenom == '') {
            $this->logger->error('Erreur : impossible de creer le compte, des informations sont manquantes');
            throw new RegisterValueException();
        } else {
            $now = new DateTime('now', new DateTimeZone('Europe/Paris'));
            $refreshTokenExpDate = $now->modify('+1 hour');

            $utilisateur = new Utilisateur();
            $utilisateur->email = $email;
            $utilisateur->mdp = password_hash($mdp, PASSWORD_BCRYPT);
            $utilisateur->nom = $nom;
            $utilisateur->prenom = $prenom;
            $utilisateur->typeUtil = 1;
            $utilisateur->refresh_token = bin2hex(random_bytes(32));
            $utilisateur->refresh_token_expiration_date = $refreshTokenExpDate->format('Y-m-d H:i:s');
            $utilisateur->save();
            $this->logger->info('Utilisateur :Nouvel utilisateur creer');
        }
    }


}

