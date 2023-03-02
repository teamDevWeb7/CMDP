<?php

namespace App\User\action;

use Core\toaster\Toaster;
use Model\Entity\Chantier;
use Doctrine\ORM\EntityManager;
use Core\Framework\Router\Router;
use Core\Session\SessionInterface;
use Doctrine\ORM\EntityRepository;
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
    private EntityRepository $repository;
    private SessionInterface $session;
    private EntityManager $manager;

    public function __construct(ContainerInterface $container){
        $this->container=$container;
        $this->renderer=$container->get(RendererInterface::class);
        $this->toaster=$container->get(Toaster::class);
        $this->router=$container->get(Router::class);
        $this->session=$container->get(SessionInterface::class);
        $this->manager=$container->get(EntityManager::class);
        $this->repository=$container->get(EntityManager::class)->getRepository(Chantier::class);

        // repo photos ? 80% oui
    }

    // rendre les vues correspondantes aux noms des pages
    public function accueil(ServerRequest $request){
        return $this->renderer->render('@user/accueil');
    }

    public function aPropos(ServerRequest $request){
        return $this->renderer->render('@user/aPropos');
    }

    public function chantiers(ServerRequest $request){
        return $this->renderer->render('@user/chantiers');
    }

    public function contact(ServerRequest $request){
        return $this->renderer->render('@user/contact');
    }

    public function devis(ServerRequest $request){
        return $this->renderer->render('@user/devis');
    }

    public function faq(ServerRequest $request){
        return $this->renderer->render('@user/FAQ');
    }

    public function chantier(ServerRequest $request){
        return $this->renderer->render('@user/infosChantier');
    }

    public function mentionsLeg(ServerRequest $request){
        return $this->renderer->render('@user/ML');
    }
}