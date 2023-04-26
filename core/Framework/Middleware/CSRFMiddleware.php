<?php

namespace Core\Framework\Middleware;

use Core\Framework\security\CSRF;
use Exception;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class CSRFMiddleware extends AbstractMiddleware{
    // attraper requete
    //  verifier methode
    //  si methode ns interesse on check token

    // recup objet csrf
    private CSRF $csrf;
    private array $excludeUrls;
    
    public function __construct(ContainerInterface $container, array $excludeUrls=[]){
        $this->csrf=$container->get(CSRF::class);
        $this->excludeUrls=$excludeUrls;
    }

    public function process(ServerRequestInterface $request){
        $method=$request->getMethod();
        // je recup le chemin de la route
        $route=$request->getUri()->getPath();
        if(in_array($method, ['POST', 'PUT','PATCH', 'DELETE']) && !in_array($route, $this->excludeUrls)){
            // ds le cas d'une attaque on a pas forcement token de créé
            $data=$request->getParsedBody();
            // on verif si clé, si on a rien on a null
            $token=$data[$this->csrf->getFormKey()] ?? null;
            // si check token return false
            if(!$this->csrf->checkToken($token)){
                throw new Exception('Token CSRF invalide');
            }

        }
        // si method !tableau on passe au middleware suivant
        return parent::process($request);
    }
}