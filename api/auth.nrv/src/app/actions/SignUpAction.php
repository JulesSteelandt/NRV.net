<?php

namespace nrv\auth\app\actions;

use nrv\auth\domain\dto\CredentialsDTO;
use nrv\auth\domain\service\AuthServiceInterface;
use PHPUnit\Util\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SignUpAction extends AbstractAction {

    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $s) {
        $this->authService = $s;
    }

    public
    function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $data = $request->getParsedBody();
        if (isset($data['email']) && isset($data['mdp']) && isset($data['nom']) && isset($data['prenom'])) {
            $email = $data['email'];
            $mdp = $data['mdp'];
            $nom = $data['nom'];
            $prenom = $data['prenom'];

            try {
                $userDTO = $this->authService->signup(new CredentialsDTO($email, $mdp, $nom, $prenom));
                $data = [
                    'email' => $userDTO->email,
                    'nom' => $userDTO->nom,
                    'prenom' => $userDTO->prenom,
                    'typeUtil' => $userDTO->typeUtil,
                ];
                $response = $response->withStatus(200)->withHeader('Content-Type', 'application/json');
                $response->getBody()->write(json_encode($data));
            } catch (Exception $e) {
                $responseMessage = array(
                    "message" => "401 Inscription failed",
                    "exception" => array(
                        "type" => $e::class,
                        "code" => $e->getCode(),
                        "message" => $e->getMessage(),
                        "file" => $e->getFile(),
                        "line" => $e->getLine()
                    )
                );
                $response = $response->withStatus(401)->withHeader('Content-Type', 'application/json');
                $response->getBody()->write(json_encode($responseMessage));
            }

        } else {
            $response = $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode(array("message" => "Données d'inscription incomplètes")));
        }
        return $response;
    }
}