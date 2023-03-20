<?php

namespace App\User\action;

use Core\toaster\Toaster;
use Doctrine\ORM\EntityManager;
use Core\Framework\Router\Router;
use Core\Session\SessionInterface;
use Psr\Container\ContainerInterface;
use Core\Framework\Router\RedirectTrait;
use Core\Framework\Renderer\RendererInterface;
use Core\Framework\Validator\Validator;
use GuzzleHttp\Psr7\ServerRequest;
use Model\Entity\Message;
use Model\Entity\Prospect;

class UserAction{

    use RedirectTrait;

    private ContainerInterface $container;
    private RendererInterface $renderer;
    private Toaster $toaster;
    private Router $router;
    private SessionInterface $session;
    private EntityManager $manager;
    private $userRepo;
    private $messRepo;

    public function __construct(ContainerInterface $container){
        $this->container=$container;
        $this->renderer=$container->get(RendererInterface::class);
        $this->toaster=$container->get(Toaster::class);
        $this->router=$container->get(Router::class);
        $this->session=$container->get(SessionInterface::class);
        $this->manager=$container->get(EntityManager::class);
        $this->userRepo=$container->get(EntityManager::class)->getRepository(Prospect::class);
        $this->messRepo=$container->get(EntityManager::class)->getRepository(Message::class);
    }

    // rendre les vues correspondantes aux noms des pages
    public function accueil(ServerRequest $request){
        return $this->renderer->render('@user/accueil', ['siteName' => 'Cmydesignprojets']);
    }

    public function aPropos(ServerRequest $request){
        return $this->renderer->render('@user/aPropos', ['siteName' => 'Cmydesignprojets']);
    }

    public function contact(ServerRequest $request){
        $method=$request->getMethod();

        if($method === 'POST'){
            $data=$request->getParsedBody();
            // pot de miel
            if(!empty($data['sujet'])){
                return $this->redirect('contact');
            }
            // if(){
            //     // captcha pas coché
            // }
            else{
                $validator=new Validator($data);
                // check ts champs ok
                $errors=$validator
                                ->required('nom', 'prenom', 'mail', 'tel', 'message')
                                ->email('mail')
                                ->tel('tel')
                                ->getErrors();
                // si champs pas remplis ou mail pas correct renvoie toast+redirect
                if($errors){
                    foreach($errors as $error){
                        $this->toaster->makeToast($error->toString(), Toaster::ERROR);
                        return $this->redirect('contact');
                    }
                }
                // laver message
                // relier au client si existe deja sinon creer
                // flush execute
            }
        }else{
            return $this->renderer->render('@user/contact', ['siteName' => 'Cmydesignprojets']);
        }
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