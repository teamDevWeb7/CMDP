<?php

namespace App\User\action;

use Core\toaster\Toaster;
use Doctrine\ORM\EntityManager;
use Core\Framework\Router\Router;
use Core\Session\SessionInterface;
use Psr\Container\ContainerInterface;
use Core\Framework\Router\RedirectTrait;
use Core\Framework\Renderer\RendererInterface;
use GuzzleHttp\Psr7\ServerRequest;

class UserAction{

    use RedirectTrait;

    private ContainerInterface $container;
    private RendererInterface $renderer;
    private Toaster $toaster;
    private Router $router;
    private SessionInterface $session;
    private EntityManager $manager;

    public function __construct(ContainerInterface $container){
        $this->container=$container;
        $this->renderer=$container->get(RendererInterface::class);
        $this->toaster=$container->get(Toaster::class);
        $this->router=$container->get(Router::class);
        $this->session=$container->get(SessionInterface::class);
        $this->manager=$container->get(EntityManager::class);
    }

    // rendre les vues correspondantes aux noms des pages
    public function accueil(ServerRequest $request){
        return $this->renderer->render('@user/accueil', ['siteName' => 'Cmydesignprojets']);
    }

    public function aPropos(ServerRequest $request){
        return $this->renderer->render('@user/aPropos', ['siteName' => 'Cmydesignprojets']);
    }

    public function contact(ServerRequest $request){
        return $this->renderer->render('@user/contact', ['siteName' => 'Cmydesignprojets']);
    }

    public function devis(ServerRequest $request){
        return $this->renderer->render('@user/devis', ['siteName' => 'Cmydesignprojets']);
    }

    public function faq(ServerRequest $request){
        return $this->renderer->render('@user/FAQ', ['siteName' => 'Cmydesignprojets']);
    }

    public function mentionsLeg(ServerRequest $request){
        return $this->renderer->render('@user/ML', ['siteName' => 'Cmydesignprojets']);
    }
}