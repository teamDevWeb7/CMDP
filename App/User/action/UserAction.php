<?php

namespace App\User\action;

use Model\Entity\Pdf;
use Core\toaster\Toaster;
use Model\Entity\Message;
use Model\Entity\Prospect;
use Spipu\Html2Pdf\Html2Pdf;
use GuzzleHttp\Psr7\Response;
use Doctrine\ORM\EntityManager;
use Core\Framework\Router\Router;
use Core\Session\SessionInterface;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;
use Core\Framework\Validator\Validator;
use Core\Framework\Router\RedirectTrait;
use Core\Framework\Renderer\RendererInterface;

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
                    $this->toaster->makeToast("<my-p class='lang' key='captcha'>La validation du captcha est nécessaire à l'envoi</my-p>", Toaster::ERROR);
                    return $this->redirect('contact');
                // captcha ok
                }else{
                    $validator=new Validator($data);
                    // check ts champs ok
                    $errors=$validator
                                    ->required('nom', 'prenom', 'mail', 'tel', 'message')
                                    ->email('mail')
                                    // pb 1 seule erreur
                                    ->getErrors();
                    // si champs pas remplis ou input !value demandée, renvoie toast+redirect
                    if($errors){
                        foreach($errors as $error){
                            $this->toaster->makeToast($error->toString(), Toaster::ERROR);
                            return $this->redirect('contact');
                        }
                    }

                    $prospect=$this->userRepo->findOneBy(['mail' => $data['mail']]);
                    $message= new Message;
                    $message->setMessage($data['message']);

                    if($prospect){
                        $prospect->addMessage($message);
                        $message->setProspect($prospect);
                    }
                    else{
                        $prosp= new Prospect;
                        $prosp->setNom($data['nom'])
                                ->setPrenom($data['prenom'])
                                ->setMail($data['mail'])
                                ->setPhone($data['tel'])
                                ->addMessage($message);
                                $message->setProspect($prosp);
                        $this->manager->persist($prosp);
                    }
                    $this->manager->persist($message);
                    $this->manager->flush();

                    $this->toaster->makeToast("<my-p class='lang' key='sendMess'>Votre message a bien été envoyé</my-p>", Toaster::SUCCESS);
                    return $this->redirect('contact');
                }  
            }
        }
        else{
            return $this->renderer->render('@user/contact', ['siteName' => 'Cmydesignprojets']);
        };

    }

    public function devis(ServerRequest $request){
        // header('Location: http://localhost:8000/App/User/action/UserAction.php');
        $method=$request->getMethod();
        if($method=='POST'){
            $data=$request->getParsedBody();
            
            // pot de miel
            if(!empty($data['sujet'])){
                return $this->redirect('devis');
            }else{
                // captcha
                // clé secrète donnée par google
                $cle='6LfpX-ckAAAAAN9NuwK9BKuWBfPekgenk1TinPU6';
                $response = $_POST['g-recaptcha-response'];

                $gapi = 'https://www.google.com/recaptcha/api/siteverify?secret='.$cle.'&response='.$response;

                $json = json_decode(file_get_contents($gapi), true);

                // if captcha pas sélectionné
                if(!$json['success']){
                    $this->toaster->makeToast("<my-p class='lang' key='captcha'>La validation du captcha est nécessaire à l'envoi</my-p>", Toaster::ERROR);
                    return $this->redirect('devis');
                // captcha ok
                }else{
                    
                    $validator=new Validator($data);
                    // check ts champs ok
                    $errors=$validator
                                    // ->required('nom', 'prenom', 'mail', 'tel')
                                    // ->email('mail')
                                    // pb 1 seule erreur
                                    ->getErrors();
                    // si champs pas remplis ou input !value demandée, renvoie toast+redirect
                    if($errors){
                        foreach($errors as $error){
                            $this->toaster->makeToast($error->toString(), Toaster::ERROR);
                            return $this->redirect('devis');
                        }
                    }

                    // header("Access-Control-Allow-Origin: localhost:8000");


                    // var_dump($_POST['monBien']);
                    // $monBien=$_POST['monBien'];
                    // $mesBesoins=$_POST['mesBesoins'];
                    // $monMessage=$_POST['monMessage'];

                    var_dump($_GET['monBien']);
                    $monBien=$_GET['monBien'];
                    $mesBesoins=$_GET['mesBesoins'];
                    $monMessage=$_GET['monMessage'];

                    $content='
                    
                        <h1 style="width:100%; text-align:center; font-size:25px; margin: 30px 0">Récapitulatif de votre demande de devis</h1>
                    
                    
                        <h2 style="font-size:20px; font-weight:400; margin-top:60px; margin-bottom:-20px">Votre bien à rénover :</h2>
                        <p style="font-size:20px; font-weight:400">'.$monBien.'</p>
                        <h2 style="font-size:20px; font-weight:400; margin-bottom:-20px">Les services dont vous pensez avoir besoin :</h2>
                        <p style="font-size:20px; font-weight:400">'.$mesBesoins.'</p>
                        <h2 style="font-size:20px; font-weight:400; margin-bottom:-20px">Votre description du projet :</h2>
                        <p style="font-size:20px; font-weight:400">'.$monMessage.'</p>
                    
                    <p style="font-size:20px; font-weight:400; margin-top:60px; width:100%; text-align:center">Produit par Cmydesignprojets</p>
                    ';

                    $html2pdf= new Html2Pdf('P', 'A4', 'fr');
                    
                    $html2pdf->writeHTML($content);
                    
                    // pdfs s'écrasent

                    // server local + affiche chez client
                    $html2pdf->output(dirname(__DIR__, 2). DIRECTORY_SEPARATOR .'Admin'. DIRECTORY_SEPARATOR.'pdfs'. DIRECTORY_SEPARATOR.'CmydesignprojetsDemandeDevis.pdf','FI');
                    



                    // $prospect=$this->userRepo->findOneBy(['mail' => $data['mail']]);
                    // $pdf= new Pdf;
                    // // $pdf->setPdfPath();

                    // if($prospect){
                    //     $prospect->addPdf($pdf);
                    //     $pdf->setProspect($prospect);
                    // }
                    // else{
                    //     $prosp= new Prospect;
                    //     $prosp->setNom($data['nom'])
                    //             ->setPrenom($data['prenom'])
                    //             ->setMail($data['mail'])
                    //             ->setPhone($data['tel'])
                    //             ->addPdf($pdf);
                    //             $pdf->setProspect($prosp);
                    //     $this->manager->persist($prosp);
                    // }
                    // $this->manager->persist($pdf);
                    // $this->manager->flush();

                    $this->toaster->makeToast("<my-p class='lang' key='devisSend'>Votre demande de devis a bien été envoyée</my-p>", Toaster::SUCCESS);
                    return $this->redirect('devis');
                    
                }
            }    
        }
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