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
use GuzzleHttp\Psr7\Stream;
use Spipu\Html2Pdf\Html2Pdf;


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

    /**
     * afficher la liste des prospects
     *
     * @param ServerRequest $request
     * @return void
     */
    public function prospects(ServerRequest $request){
        $prospects=$this->prospectsRepo->findBy([],[
            'id' => 'DESC'
        ]);
        return $this->renderer->render('@admin/prospectsView', ["prospects"=>$prospects]);
    }

    /**
     * affiche toutes les infos d'un prospect selon sin ID
     *
     * @param ServerRequest $request
     * @return void
     */
    public function prospect(ServerRequest $request){
        $id=$request->getAttribute('id');
        $prospect=$this->prospectsRepo->find($id);
        $messages=$this->messageRepo->findBy(array('prospect'=>$id),[
            'id' => 'DESC'
        ]);
        $devis=$this->pdfRepo->findBy(array('prospect'=>$id),[
            'id' => 'DESC'
        ]);
        if(!$prospect){
            return new Response(404,[], 'Aucun prospect ne correspond');
        }
        return $this->renderer->render('@admin/prospectView', ["prospect"=>$prospect, "messages"=>$messages, "devis"=>$devis]);
    }

    /**
     * Permet la suppression d'un prospect grâce à son ID
     *
     * @param ServerRequest $request
     * @return void
     */
    public function deleteProspect(ServerRequest $request){
        $id=$request->getAttribute('id');
        $prospect=$this->prospectsRepo->find($id);
        $this->manager->remove($prospect);
        $this->manager->flush();
        $this->toaster->makeToast('Prospect supprimé avec succès', Toaster::SUCCESS);
    
        return $this->redirect('prospects');
    }

    /**
     * Permet de modifier le nom, prénom, mail, téléphone du prospect
     *
     * @param ServerRequest $request
     * @return void
     */
    public function updateProspect(ServerRequest $request){
        $id=$request->getAttribute('id');
        $prospect=$this->prospectsRepo->find($id);
        if(!$prospect){
            $this->toaster->makeToast('Aucun prospect ne correspond', Toaster::ERROR);
            return $this->redirect('prospects');
        }

        $method=$request->getMethod();
        if($method==='POST'){
            $data=$request->getParsedBody();
            if(($data['nom']===$prospect->getNom()) 
                && ($data['prenom']===$prospect->getPrenom())
                && ($data['mail']===$prospect->getMail())
                && ($data['tel']===$prospect->getPhone())){
                $this->toaster->makeToast('Aucune modification n\'a été renseignée donc aucune valeur n\'a été modifiée', Toaster::ERROR);
                return $this->redirect('prospects');
            }

            $prospect->setNom($data['nom'])
                    ->setPrenom($data['prenom'])
                    ->setMail($data['mail'])
                    ->setPhone($data['tel']);

            $this->manager->flush();
            $this->toaster->makeToast('Prospect modifié avec succès', Toaster::SUCCESS);
            return $this->redirect('prospects');
        }
        
        return $this->renderer->render('@admin/updateProsp', ["prospect"=>$prospect]);
    }





    public function pageDevis(ServerRequest $request){
        $devis=$this->pdfRepo->findBy([],[
            'id' => 'DESC'
        ]);
        return $this->renderer->render('@admin/devis', ["devis"=>$devis]);
    }


    public function affichePdf(ServerRequest $request){

        $filePdf = $request->getAttribute('filename').'.pdf'; 
        // part de l'index dans public
        $path = '../App/Admin/pdfs'.DIRECTORY_SEPARATOR.$filePdf;

        // check si existe
        if(!file_exists($path)){
            $this->toaster->makeToast('Aucun fichier n\'a été trouvé', Toaster::ERROR);
            return $this->redirect('pageDevis');
        }

        $stream = new Stream(fopen($path, 'r'));
        $pdf = new Html2Pdf();

        try {
            // on va ouvrir un pdf
            $pdf->output($filePdf.'.pdf', 'I');
        } catch (\Exception $e) {
            $this->toaster->makeToast('Une erreur s\'est produite lors de l\'ouverture du fichier', Toaster::ERROR);
            return $this->redirect('pageDevis');
        }

        // on injecte le contenu dans le pdf
        return $stream->getContents();
    }

    public function deleteDevis(ServerRequest $request){
        $id=$request->getAttribute('id');
        $devis=$this->pdfRepo->find($id);
        $devisASuppr=$devis->getPdfPath();

        $chemin=$this->container->get('pdf.basePath').$devisASuppr.'.pdf';
        unlink($chemin);
        
        $this->manager->remove($devis);
        $this->manager->flush();

        $this->toaster->makeToast('Devis supprimé avec succès', Toaster::SUCCESS);
    
        return $this->redirect('pageDevis');
    }

    /**
     * fonction pour gérer l'état du pdf du devis -> traité ou en attente
     *
     * @param ServerRequest $request
     * @return void
     */
    public function switchVu(ServerRequest $request){
        $id=$request->getAttribute('id');
        $pdf=$this->pdfRepo->find($id);
        if($pdf->getVu()==false){
            $pdf->setVu(true);
        }else{
            $pdf->setVu(false);
        }
        $this->manager->persist($pdf);
        $this->manager->flush();
        return $this->redirect('pageDevis');
    }





    /**
     * render la page pageMessage
     *
     * @param ServerRequest $request
     * @return void
     */
    public function pageMessages(ServerRequest $request){
        $messages=$this->messageRepo->findBy([],[
            'id' => 'DESC'
        ]);
        return $this->renderer->render('@admin/messages', ["messages"=>$messages]);
    }

    /**
     * fonction pour gérer état du message : traité ou non
     *
     * @param ServerRequest $request
     * @return void
     */
    public function switchEtat(ServerRequest $request){
        $id=$request->getAttribute('id');
        $message=$this->messageRepo->find($id);
        if($message->getTraite()==false){
            $message->setTraite(true);
        }else{
            $message->setTraite(false);
        }
        $this->manager->persist($message);
        $this->manager->flush();
        return $this->redirect('pageMessages');
    }

    /**
     * fonction qui permet à l'admin de supprimer un message depuis pageMessage
     *
     * @param ServerRequest $request
     * @return void
     */
    public function deleteMess(ServerRequest $request){
        $id=$request->getAttribute('id');
        $message=$this->messageRepo->find($id);
        $this->manager->remove($message);
        $this->manager->flush();
        $this->toaster->makeToast('Message supprimé avec succès', Toaster::SUCCESS);
    
        return $this->redirect('pageMessages');
    }

    // $minutesBeforeSessionExpire=30;
    // if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire*60))) {
    //     session_unset();     // unset $_SESSION   
    //     session_destroy();   // destroy session data  
    // }
    // $_SESSION['LAST_ACTIVITY'] = time(); // update last activity
}