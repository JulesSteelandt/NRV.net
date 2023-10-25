<?php

namespace nrv\catalogue\app\actions;

use nrv\catalogue\app\actions\AbstractAction;
use nrv\catalogue\domain\service\ServiceSpectacle;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCatalogueAction extends AbstractAction
{

    private ServiceSpectacle $serviceSpectacle;

    /**
     * @param ServiceSpectacle $serviceSpectacle
     */
    public function __construct(ServiceSpectacle $serviceSpectacle)
    {
        $this->serviceSpectacle = $serviceSpectacle;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: Implement __invoke() method.
    }
}