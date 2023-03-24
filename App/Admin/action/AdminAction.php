<?php

namespace App\Admin\action;

use Model\Entity\Prospect;
use GuzzleHttp\Psr7\Response;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;
use Core\Framework\Router\RedirectTrait;
use Core\Framework\Renderer\RendererInterface;
use Core\Framework\Router\Router;
use Core\Session\SessionInterface;
use Core\toaster\Toaster;
use Model\Entity\Message;
use Model\Entity\Pdf;

class AdminAction{
    use RedirectTrait;

    private ContainerInterface $container;
    private RendererInterface $renderer;
    private EntityRepository $prospectsRepo;
    private EntityRepository $pdfRepo;
    private EntityRepository $messageRepo;
    private Router $router;
    private Toaster $toaster;
    private SessionInterface $session;
    private EntityManager $manager;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->renderer=$container->get(RendererInterface::class);
        $this->router=$container->get(Router::class);
        $this->toaster=$container->get(Toaster::class);
        $this->session=$container->get(SessionInterface::class);
        $this->manager=$container->get(EntityManager::class);
        $this->prospectsRepo=$container->get(EntityManager::class)->getRepository(Prospect::class);
        $this->pdfRepo=$container->get(EntityManager::class)->getRepository(Pdf::class);
        $this->messageRepo=$container->get(EntityManager::class)->getRepository(Message::class);
    }

    public function connexion(ServerRequest $request){
        return $this->renderer->render('@admin/connexion');
    }

    public function accueilAdmin(ServerRequest $request){
        return $this->renderer->render('@admin/accueilAdmin');
    }

    public function prospects(ServerRequest $request){
        $prospects=$this->prospectsRepo->findAll();
        return $this->renderer->render('@admin/prospectsView', ["prospects"=>$prospects]);
    }

    public function prospect(ServerRequest $request){
        $id=$request->getAttribute('id');
        $prospect=$this->prospectsRepo->find($id);
        if(!$prospect){
            return new Response(404,[], 'Aucun prospect ne correspond');
        }
        return $this->renderer->render('@admin/prospectView', ["prospect"=>$prospect]);
    }

    public function pageDevis(ServerRequest $request){
        $devis=$this->pdfRepo->findAll();
        return $this->renderer->render('@admin/devis', ["devis"=>$devis]);
    }

    public function pageMessages(ServerRequest $request){
        $messages=$this->messageRepo->findAll();
        return $this->renderer->render('@admin/messages', ["messages"=>$messages]);
    }
}