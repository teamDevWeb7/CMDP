<?php

namespace Core\Framework\Middleware;

use Core\toaster\Toaster;
use GuzzleHttp\Psr7\Response;
use Core\Framework\Auth\AdminAuth;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * check si la route est protegée grâce au début de l url 
 * si oui on s assure que le user a le droit d y acceder
 */
class AdminAuthMiddleware extends AbstractMiddleware{

    private ContainerInterface $container;
    private Toaster $toaster;

    public function __construct(ContainerInterface $container){

        $this->container=$container;
        $this->toaster=$container->get(Toaster::class);
    }

    public function process(ServerRequestInterface $request){
        $uri=$request->getUri()->getPath();
        // on check si l url commence par '/admin' et n est pas égale à '/admin/connectAdmin'
        if(str_starts_with($uri, '/admin')&& $uri !=='/admin/connectAdmin'){
            // recup l objet qui gere l admin 
            $auth=$this->container->get(AdminAuth::class);
            // on check si est bien un admin
            if($auth->isAdmin()==false){
                $this->toaster->makeToast("Vous ne passerez pas !", Toaster::ERROR);
                return (new Response())
                    ->withHeader('Location', '/');
            }
            
        
        }
        return parent::process($request);
        
    }
}