<?php

namespace nrv\auth\app\auth\managers;


use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use nrv\auth\api\domain\exception\JwtExpiredException;
use nrv\auth\api\domain\exception\JwtInvalidException;

class JwtManager {

    public function create(array $user): string {
        $payload = [
            'iss' => "nrv.auth.db",
            'iat' => time(),
            'exp' => time() + $_ENV['JWT_EXPIRATION'],
            'upr' => [
                'email' => $user['email'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'typeUtil' => $user['typeUtil'],
            ],
        ];

        return JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS512');
    }


    public function validate(string $token): stdClass {
        try {
            return JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS512'));
        } catch (ExpiredException $e) {
            throw new JwtExpiredException();
        } catch (SignatureInvalidException $e) {
            throw new JwtInvalidException('signature');
        } catch (UnexpectedValueException $e) {
            throw new JwtInvalidException('invalid');
        }
    }
}