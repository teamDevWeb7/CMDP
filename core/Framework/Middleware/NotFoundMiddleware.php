<?php

namespace Core\Framework\Middleware;

use Core\Framework\Renderer\RendererInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

/**
 * si la requete arrive ici une erreur 404 est émise
 * Il est possible de rediriger vers une page
 */
class NotFoundMiddleware extends AbstractMiddleware{


    public function process(ServerRequestInterface $request)
    {
        // return new Response(404, [], "not found middleware");
        return (new Response)->withHeader('Location', 'PageNotFound');
    }
}