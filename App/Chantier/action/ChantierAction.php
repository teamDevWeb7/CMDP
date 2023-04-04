<?php
namespace App\Chantier\action;

use Core\toaster\Toaster;
use Model\Entity\Chantier;
use GuzzleHttp\Psr7\Response;
use Doctrine\ORM\EntityManager;
use Core\Framework\Router\Router;
use Core\Session\SessionInterface;
use Doctrine\ORM\EntityRepository;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;
use Core\Framework\Router\RedirectTrait;
use Core\Framework\Renderer\RendererInterface;
use Core\Framework\Validator\Validator;
use GuzzleHttp\Psr7\UploadedFile;
use Model\Entity\Photo;

class ChantierAction{

    use RedirectTrait;

    private ContainerInterface $container;
    private RendererInterface $renderer;
    private Toaster $toaster;
    private Router $router;
    private EntityRepository $chantiersRepo;
    private EntityRepository $photoRepo;
    private SessionInterface $session;
    private EntityManager $manager;

    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->renderer=$container->get(RendererInterface::class);
        $this->toaster=$container->get(Toaster::class);
        $this->router=$container->get(Router::class);
        $this->session=$container->get(SessionInterface::class);
        $this->manager=$container->get(EntityManager::class);
        $this->chantiersRepo=$container->get(EntityManager::class)->getRepository(Chantier::class);
        $this->photoRepo=$container->get(EntityManager::class)->getRepository(Photo::class); 
        
    }

    // client
    public function chantiers(ServerRequest $request){
        $chantiers=$this->chantiersRepo->findAll();
        return $this->renderer->render('@chantier/chantiersUser', ["chantiers"=>$chantiers]);
    }

    public function chantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);
        // je veux recup l id du chantier pour get les photos qui lui sont attachées
        $photos=$this->photoRepo->findBy(array('chantier'=>$id));
        if(!$chantier){
            return new Response(404,[], 'Aucun chantier ne correspond');
        }
        return $this->renderer->render('@chantier/infosChantierUser', ["chantier"=>$chantier, "photos"=>$photos]);
    }


    // admin
    public function adminChantiers(ServerRequest $request){
        $chantiers=$this->chantiersRepo->findAll();
        return $this->renderer->render('@chantier/chantiersAdmin', ["chantiers"=>$chantiers]);
    }

    public function adminChantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);
        $photos=$this->photoRepo->findBy(array('chantier'=>$id));
        if(!$chantier){
            return new Response(404,[], 'Aucun chantier ne correspond');
        }
        return $this->renderer->render('@chantier/chantierAdmin', ["chantier"=>$chantier, "photos"=>$photos]);
    }

    public function addChantier(ServerRequest $request){
        $method=$request->getMethod();

        if($method==='POST'){
            $data=$request->getParsedBody();
            $file=$request->getUploadedFiles()['img'];

            $validator=new Validator($data);
            $errors=$validator->required('title', 'desc')->getErrors();
            if($errors){
                foreach($errors as $error){
                    $this->toaster->makeToast($error->toString(), Toaster::ERROR);
                }
                return $this->redirect('addChantier');
            }

            $chantiers=$this->chantiersRepo->findAll();
            foreach($chantiers as $chantier){
                if($chantier->getDesc()==$data['desc'] || $chantier->getNomChantier()==$data['title']){
                    $this->toaster->makeToast('Le nom du chantier et sa description doivent être uniques', Toaster::ERROR);
                    return $this->redirect('addChantier');
                }
            }

            // traitement img
            $error=$this->fileGuard($file);
            if($error !== true){
                return $error;
            }

            $fileName=$file->getClientFileName();
            $imgPath=$this->container->get('img.basePath').$fileName;
            $file->moveTo($imgPath);
            if(!$file->isMoved()){
                $this->toaster->makeToast("Une erreur s'est produite",Toaster::ERROR);
                return $this->redirect('addChantier');
            }



            $presChantier=new Chantier;
            $presChantier->setNomChantier($data['title'])
                            ->setDateChantier($data['date'])
                            ->setLieu($data['lieu'])
                            ->setDesc($data['desc'])
                            ->setImgPathChantier($fileName);

            $this->manager->persist($presChantier);
            $this->manager->flush();

            $this->toaster->makeToast('Chantier créé avec succès', Toaster::SUCCESS);
            return $this->redirect('adminChantiers');
        }
        return $this->renderer->render('@chantier/addChantier');
    }

    public function updateChantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);
        $photos=$this->photoRepo->findBy(array('chantier'=>$id));
        return $this->renderer->render('@chantier/updateChantier', ["chantier"=>$chantier, "photos"=>$photos]);
    }

    public function updatePresChantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);
        return $this->renderer->render('@chantier/updatePresChantier', ["chantier"=>$chantier]);
    }

    public function deleteChantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);
        $this->manager->remove($chantier);
        $this->manager->flush();
        $this->toaster->makeToast('Chantier supprimé avec succès', Toaster::SUCCESS);
    
        return $this->redirect('chantiers');
    }

    public function fileGuard(UploadedFile $file){
        if($file->getError()===4){
            $this->toaster->makeToast("Une erreur est survenue lors du chargement", Toaster::ERROR);
            return $this->redirect('addChantier');
        }
        list($type, $format)=explode('/', $file->getClientMediaType());

        if(!in_array($type, ['image']) or !in_array($format, ['jpg', 'jpeg', 'png'])){
            $this->toaster->makeToast("Le format de l'image n'est pas accepté, seuls les .png, .jpeg, et .jpg sont acceptés.", Toaster::ERROR);
            return $this->redirect('addChantier');
        }

        if($file->getSize()>2047674){
            $this->toaster->makeToast("La taille de l'image doit etre inférieure à 2MO", Toaster::ERROR);
            return $this->redirect('addChantier');
        }
        return true;
    }
}