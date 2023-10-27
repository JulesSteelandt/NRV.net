<?php

namespace nrv\auth\app\actions;

use nrv\auth\domain\dto\CredentialsDTO;
use nrv\auth\domain\exception\EmailFormatException;
use nrv\auth\domain\exception\RegisterExistException;
use nrv\auth\domain\exception\RegisterValueException;
use nrv\auth\domain\service\AuthServiceInterface;
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
                $response->getBody()->write(json_encode($data));
                $response = $response->withStatus(200)->withHeader('Content-Type', 'application/json');
            } catch (RegisterValueException | RegisterExistException | EmailFormatException $e) {
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
                $response->getBody()->write(json_encode($responseMessage));
                $response = $response->withStatus(401)->withHeader('Content-Type', 'application/json');
            }

        } else {
            $response->getBody()->write(json_encode(array("message" => "Données d'inscription incomplètes")));
            $response = $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }
        return $response;
    }
}