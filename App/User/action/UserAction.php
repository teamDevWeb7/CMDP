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
            }else{
                // captcha
                // clé secrète donnée par google
                $cle='6LfpX-ckAAAAAN9NuwK9BKuWBfPekgenk1TinPU6';
                $response = $_POST['g-recaptcha-response'];

                $gapi = 'https://www.google.com/recaptcha/api/siteverify?secret='.$cle.'&response='.$response;

                $json = json_decode(file_get_contents($gapi), true);

                // if captcha pas sélectionné
                if(!$json['success']){
                    $this->toaster->makeToast("La validation du captcha est nécessaire à l'envoi", Toaster::ERROR);
                    return $this->redirect('contact');
                // captcha ok
                }else{
                    $validator=new Validator($data);
                    // check ts champs ok
                    $errors=$validator
                                    ->required('nom', 'prenom', 'mail', 'tel', 'message')
                                    ->email('mail')
                                    // pb tel
                                    // ->tel('tel')
                                    // pb 1 seule erreur
                                    ->getErrors();
                    // si champs pas remplis ou input !value demandée, renvoie toast+redirect
                    if($errors){
                        foreach($errors as $error){
                            $this->toaster->makeToast($error->toString(), Toaster::ERROR);
                            return $this->redirect('contact');
                        }
                    }

                    // laver message ?

                    $prospect=$this->userRepo->find($data['mail']);
                    $message= new Message;
                    $message->setMessage($data['message']);

                    if($prospect){
                        $prospect->addMessage($message);
                        $this->manager->persist($prospect);
                    }
                    else{
                        $prosp= new Prospect;
                        $prosp->setNom($data['nom'])
                                ->setPrenom($data['prenom'])
                                ->setMail($data['mail'])
                                ->setPhone($data['tel'])
                                ->addMessage($message);
                        $this->manager->persist($prosp);
                    }
                    $this->manager->persist($message);
                    $this->manager->flush();

                    // ds ts les cas, nv Prospect et message n'a pas la clé etrangere du prospect

                    $this->toaster->makeToast("Votre message a bien été envoyé", Toaster::SUCCESS);
                    return $this->redirect('contact');
                }  
            }
        }
        else{
            return $this->renderer->render('@user/contact', ['siteName' => 'Cmydesignprojets']);
        };

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

    public function page(ServerRequest $request){
        return $this->renderer->render('@user/PageNotFound', ['siteName' => 'Cmydesignprojets']);
    }
}