<?php

namespace App\User\action;

use Model\Entity\Pdf;
use Core\toaster\Toaster;
use Model\Entity\Message;
use Model\Entity\Chantier;
use Model\Entity\Prospect;
use Spipu\Html2Pdf\Html2Pdf;
use GuzzleHttp\Psr7\Response;
use Doctrine\ORM\EntityManager;
use Core\Framework\Router\Router;
use Core\Session\SessionInterface;
use Doctrine\ORM\EntityRepository;
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
    private EntityRepository $chantiersRepo;
    private EntityRepository $userRepo;
    private EntityRepository $messRepo;

    public function __construct(ContainerInterface $container){
        $this->container=$container;
        $this->renderer=$container->get(RendererInterface::class);
        $this->toaster=$container->get(Toaster::class);
        $this->router=$container->get(Router::class);
        $this->session=$container->get(SessionInterface::class);
        $this->manager=$container->get(EntityManager::class);
        $this->userRepo=$container->get(EntityManager::class)->getRepository(Prospect::class);
        $this->messRepo=$container->get(EntityManager::class)->getRepository(Message::class);
        $this->chantiersRepo=$container->get(EntityManager::class)->getRepository(Chantier::class);
    }

    // rendre les vues correspondantes aux noms des pages
    public function accueil(ServerRequest $request){
        return $this->renderer->render('@user/accueil', ['siteName' => 'Cmydesignprojets']);
    }

    public function aPropos(ServerRequest $request){
        $chantiers=$this->chantiersRepo->findBy([], [
            'id' => 'DESC'
        ], 3);
        return $this->renderer->render('@user/aPropos', ['siteName' => 'Cmydesignprojets', 'chantiers'=>$chantiers]);
    }

    /**
     * get->affichage, post->range mess + prospect en BDD
     *
     * @param ServerRequest $request
     * @return void
     */
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
                            
                        }
                        return $this->redirect('contact');
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
            // pot de miel
            if(!empty($data['sujet'])){
                return $this->redirect('devis');
            }else{
                // captcha
                // clé secrète donnée par google
                $cle='6LfpX-ckAAAAAN9NuwK9BKuWBfPekgenk1TinPU6';
                $post=json_decode(file_get_contents('php://input'));
                $response = $post->g_recaptcha_response;

                $gapi = 'https://www.google.com/recaptcha/api/siteverify?secret='.$cle.'&response='.$response;

                $json = json_decode(file_get_contents($gapi), true);

                // if captcha pas sélectionné
                if(!$json['success']){
                    $this->toaster->makeToast("<my-p class='lang' key='captcha'>La validation du captcha est nécessaire à l'envoi</my-p>", Toaster::ERROR);
                    return $this->redirect('devis');
                // captcha ok
                }else{
                    if((!isset($post->votreNom)||$post->votreNom='')||
                    (!isset($post->votrePrenom)||$post->votrePrenom='')||
                    (!isset($post->votreMail)||$post->votreMail='')||
                    (!isset($post->votreTel)||$post->votreTel='')){
                        echo false;
                        die;
                    }
                    if(!filter_var($post->votreMail, FILTER_VALIDATE_EMAIL)){
                        echo false;
                        die;
                    }

                    $nom=strip_tags(htmlentities($post->votreNom));
                    $prenom=strip_tags(htmlentities($post->votrePrenom));
                    $mail=strip_tags(htmlentities($post->votreMail));
                    $tel=strip_tags(htmlentities($post->votreTel));

                    $data=array(
                        'nom'=>$nom,
                        'prenom'=>$prenom,
                        'mail'=>$mail,
                        'tel'=>$tel
                    );
                    
                    $monBien=$post->monBien;
                    $mesBesoins=$post->mesBesoins;
                    $monMessage=$post->monMessage;

                    $analyseBesoins='';
                    $size=sizeof($mesBesoins);

                    // var_dump($mesBesoins);

                    for($i=0; $i<$size; $i++){
                        if($i>= ($size-1)){
                            $analyseBesoins.=$mesBesoins[$i].'';
                        }else{
                            $analyseBesoins.=$mesBesoins[$i].', ';
                        }
                    }

                    date_default_timezone_set('Europe/Paris');
                    $date=date("d-m-Y_H\hi\ms\s");

                    $content='
                    
                        <h1 style="width:100%; text-align:center; font-size:25px; margin: 30px 0">Récapitulatif de la demande de devis</h1>
                    
                        <h3 style="width:100%; text-align:center; font-size:25px; margin: 30px 0, font-weight:400">'.$nom.' '.$prenom.' le '.$date.'</h3>

                        <h2 style="font-size:20px; font-weight:400; margin-top:60px; margin-bottom:-20px">Le bien à rénover :</h2>
                        <p style="font-size:20px; font-weight:400">'.$monBien.'</p>
                        <h2 style="font-size:20px; font-weight:400; margin-bottom:-20px">Les besoins exprimés :</h2>
                        <p style="font-size:20px; font-weight:400">'.$analyseBesoins.'</p>
                        <h2 style="font-size:20px; font-weight:400; margin-bottom:-20px">La description du projet :</h2>
                        <p style="font-size:20px; font-weight:400">'.$monMessage.'</p>
                    
                    ';
                    var_dump($content);

                    $html2pdf= new Html2Pdf('P', 'A4', 'fr');
                    
                    $html2pdf->writeHTML($content);


                    $pdfName='devis_'.$date.'_'.$nom.'.pdf';
                    $pdfPath=dirname(__DIR__, 2). DIRECTORY_SEPARATOR .'Admin'. DIRECTORY_SEPARATOR.'pdfs'. DIRECTORY_SEPARATOR.$pdfName;

                    $html2pdf->output($pdfPath,'F');

                    // var_dump($pdfPath);

                    $prospect=$this->userRepo->findOneBy(['mail' => $data['mail']]);
                    $pdf= new Pdf;
                    $pdf->setPdfPath($pdfName);

                    if($prospect){
                        $prospect->addPdf($pdf);
                        $pdf->setProspect($prospect);
                    }
                    else{
                        $prosp= new Prospect;
                        $prosp->setNom($data['nom'])
                                ->setPrenom($data['prenom'])
                                ->setMail($data['mail'])
                                ->setPhone($data['tel'])
                                ->addPdf($pdf);
                                $pdf->setProspect($prosp);
                        $this->manager->persist($prosp);
                    }
                    $this->manager->persist($pdf);
                    $this->manager->flush();

                    echo true;
                    if(true){
                        $this->toaster->makeToast("<my-p class='lang' key='devisSend'>Votre demande de devis a bien été envoyée</my-p>", Toaster::SUCCESS);
                    return $this->redirect('devis');
                    }
                    
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