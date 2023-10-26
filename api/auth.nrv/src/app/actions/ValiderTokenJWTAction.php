<?php

namespace nrv\auth\app\actions;

use nrv\auth\app\actions\AbstractAction;
use nrv\auth\domain\dto\TokenDTO;
use nrv\auth\domain\exception\JwtExpiredException;
use nrv\auth\domain\exception\JwtInvalidException;
use nrv\auth\domain\service\AuthServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ValiderTokenJWTAction extends AbstractAction {

    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $s) {
        $this->authService = $s;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        try {
            if (!isset($request->getHeader('Authorization')[0])){
                throw new JwtInvalidException();
            }
            $header = $request->getHeader('Authorization')[0];
            $token = str_replace('Bearer ', '', $header);
            $pUser = $this->authService->validate(new TokenDTO('', $token));
            $response->getBody()->write(json_encode($pUser));
            return $response->withStatus(200)->withHeader('Content-Type','application/json');
        } catch (JwtExpiredException $e) {
            $responseMessage = array(
                "message" => "401 token expiré",
                "exception" => array(
                    "type" => $e::class,
                    "code" => $e->getCode(),
                    "message" => $e->getMessage(),
                    "file" => $e->getFile(),
                    "line" => $e->getLine()
                )
            );

            $response->getBody()->write(json_encode($responseMessage));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');

        } catch (JwtInvalidException $e) {
            $responseMessage = array(
                "message" => "401 token invalide",
                "exception" => array(
                    "type" => $e::class,
                    "code" => $e->getCode(),
                    "message" => $e->getMessage(),
                    "file" => $e->getFile(),
                    "line" => $e->getLine()
                )
            );

            $response->getBody()->write(json_encode($responseMessage));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');

        }
    }



}