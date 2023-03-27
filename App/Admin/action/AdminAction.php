<?php

namespace App\Admin\action;

use Model\Entity\Pdf;
use Core\toaster\Toaster;
use Model\Entity\Message;
use Model\Entity\Prospect;
use GuzzleHttp\Psr7\Response;
use Doctrine\ORM\EntityManager;
use Core\Framework\Router\Router;
use Core\Framework\Auth\AdminAuth;
use Core\Session\SessionInterface;
use Doctrine\ORM\EntityRepository;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;
use Core\Framework\Validator\Validator;
use Core\Framework\Router\RedirectTrait;
use Core\Framework\Renderer\RendererInterface;

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
        $method=$request->getMethod();

        if($method==='POST'){
            $auth=$this->container->get(AdminAuth::class);
            $data=$request->getParsedBody();

            $validator=new Validator($data);
            $errors=$validator->required('mail', 'password')->getErrors();
            if(!empty($errors)){
                foreach($errors as $error){
                    $this->toaster->makeToast($error->toString(), Toaster::ERROR);
                }
                return $this->redirect('connexion');
            }

            if($auth->login($data['mail'], $data['password'])){
                $this->toaster->makeToast('Connexion réussie', Toaster::SUCCESS);
                return $this->redirect('accueilAdmin');
            }
            $this->toaster->makeToast('Connexion impossible, vos accès sont inconnus', Toaster::ERROR);
            return $this->redirect('connexion');
            
        }
        return $this->renderer->render('@admin/connexion');
    }

    public function deco(ServerRequest $request){
        $auth=$this->container->get(AdminAuth::class);
        $auth->logout();
        $this->toaster->makeToast('Déconnexion réussie', Toaster::SUCCESS);
        return $this->redirect('connexion');
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