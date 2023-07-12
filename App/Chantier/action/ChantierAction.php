<?php
namespace App\Chantier\action;

use Core\toaster\Toaster;
use Model\Entity\Chantier;
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
        $chantiers=$this->chantiersRepo->findBy([],[
            'id' => 'DESC'
        ]);
        return $this->renderer->render('@chantier/chantiersUser', ["chantiers"=>$chantiers, "siteName"=>'Cmydesignprojets']);
    }

    public function chantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);
        // je veux recup l id du chantier pour get les photos qui lui sont attachées
        $photos=$this->photoRepo->findBy(array('chantier'=>$id),[
            'id' => 'DESC'
        ]);
        if(!$chantier){
            $this->toaster->makeToast('<my-p class="lang" key="chantier">Aucun chantier ne correspond</my-p>', Toaster::ERROR);
            return $this->redirect('chantiers');
        }
        return $this->renderer->render('@chantier/infosChantierUser', ["chantier"=>$chantier, "photos"=>$photos, "siteName"=>'Cmydesignprojets']);
    }



    /**
     * premet l'affichage de tous les chantiers côté admin
     *
     * @param ServerRequest $request
     * @return void
     */
    public function adminChantiers(ServerRequest $request){
        $chantiers=$this->chantiersRepo->findBy([],[
            'id' => 'DESC'
        ]);
        return $this->renderer->render('@chantier/chantiersAdmin', ["chantiers"=>$chantiers]);
    }

    /**
     * permet de voir un chantier selon son ID
     *
     * @param ServerRequest $request
     * @return void
     */
    public function adminChantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);
        $photos=$this->photoRepo->findBy(array('chantier'=>$id),[
            'id' => 'DESC'
        ]);
        if(!$chantier){
            $this->toaster->makeToast('Aucun chantier ne correspond', Toaster::ERROR);
            return $this->redirect('chantiers');
        }
        return $this->renderer->render('@chantier/chantierAdmin', ["chantier"=>$chantier, "photos"=>$photos]);
    }

    /**
     * ajouter un chantier -> présentation avec 1photo, nom, lieu, date, desc
     *
     * @param ServerRequest $request
     * @return void
     */
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

            $ttesPhotos=$this->photoRepo->findAll();
            foreach($ttesPhotos as $photo){
                if($photo->getImgPath()==$fileName){
                    $this->toaster->makeToast('La photo, identifiée par le nom que vous lui avez donné est déjà sur le serveur', Toaster::ERROR);
                    return $this->redirect('addChantier');
                }
            }

            
            $imgPath=$this->container->get('img.basePath'). DIRECTORY_SEPARATOR .$fileName;
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

    /**
     * Sert à ajouter une photo au chantier
     *
     * @param ServerRequest $request
     * @return void
     */
    public function updateChantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);
        $photos=$this->photoRepo->findBy(array('chantier'=>$id));

        $method=$request->getMethod();

        if($method=='POST'){
            $data=$request->getParsedBody();
            $file=$request->getUploadedFiles()['img'];

            $validator=new Validator($data);
            $errors=$validator->required('txt')->getErrors();
            if($errors){
                foreach($errors as $error){
                    $this->toaster->makeToast($error->toString(), Toaster::ERROR);
                }
                return $this->redirect('adminChantier', ["id"=>$id]);
            }

            // traitement img
            $error=$this->fileGuard($file, $id);
            if($error !== true){
                return $error;
            }

            $fileName=$file->getClientFileName();

            $ttesPhotos=$this->photoRepo->findAll();
            foreach($ttesPhotos as $photo){
                if($photo->getImgPath()==$fileName){
                    $this->toaster->makeToast('La photo, identifiée par le nom que vous lui avez donné est déjà sur le serveur', Toaster::ERROR);
                    return $this->redirect('adminChantier', ["id"=>$id]);
                }
            }

            $imgPath=$this->container->get('img.basePath').$fileName;
            $file->moveTo($imgPath);
            if(!$file->isMoved()){
                $this->toaster->makeToast("Une erreur s'est produite",Toaster::ERROR);
                return $this->redirect('adminChantier', ["id"=>$id]);
            }

            $img=new Photo;
            $img->setImgPath($fileName)->setDescImg($data['txt'])->setChantier($chantier);
            $chantier->addPhoto($img);
            $this->manager->persist($chantier);
            $this->manager->persist($img);
            $this->manager->flush();

            $this->toaster->makeToast("Votre photo a bien été ajoutée", Toaster::SUCCESS);
            return $this->redirect('adminChantier', ["id"=>$id]);

        }

        return $this->renderer->render('@chantier/updateChantier', ["chantier"=>$chantier, "photos"=>$photos]);
    }

    /**
     * modifier mon image -> modif la desc
     *
     * @param ServerRequest $request
     * @return void
     */
    public function updatePhoto(ServerRequest $request){
        $id=$request->getAttribute('id');
        $photo=$this->photoRepo->find($id);

        $chan=$photo->getChantier();
        $idd=$chan->getId();


        $method=$request->getMethod();

        if($method=='POST'){
            $data=$request->getParsedBody();
            
            $validator=new Validator($data);
            $errors=$validator->required('txt')->getErrors();
            if($errors){
                foreach($errors as $error){
                    $this->toaster->makeToast($error->toString(), Toaster::ERROR);
                }
                return $this->redirect('adminChantier', ["id"=>$idd]);
            }

            if($data['txt']==$photo->getDescImg()){
                $this->toaster->makeToast("Aucune modification n'a été envoyée", Toaster::ERROR);
                return $this->redirect('adminChantier', ["id"=>$idd]);
            }

            $photo->setDescImg($data['txt']);
            $this->manager->persist($photo);
            $this->manager->flush();

            $this->toaster->makeToast("La modification de la description de la photo a bien été prise en compte", Toaster::SUCCESS);
            return $this->redirect('adminChantier', ["id"=>$idd]);
        }

        return $this->renderer->render('@chantier/updatePhoto', ["photo"=>$photo]);
    }

    /**
     * dans chantier, permet supprimer une photo et sa desc
     *
     * @param ServerRequest $request
     * @return void
     */
    public function deletePhoto(ServerRequest $request){
        $id=$request->getAttribute('id');
        $photo=$this->photoRepo->find($id);

        $chan=$photo->getChantier();
        $idd=$chan->getId();

        $this->manager->remove($photo);
        $this->manager->flush();
        $photoASuppr=$photo->getImgPath();
        $chemin=$this->container->get('img.basePath').$photoASuppr;

        unlink($chemin);

        $this->toaster->makeToast('Photo supprimée avec succès', Toaster::SUCCESS);
        return $this->redirect('adminChantier', ["id"=>$idd]);
    }

    /**
     * Modifier les infos globales du chantier ->nom, date, lieu, img, description
     *
     * @param ServerRequest $request
     * @return void
     */
    public function updatePresChantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);

        $method=$request->getMethod();
        if($method=='POST'){
            $data=$request->getParsedBody();

            // mettre btn je veux changer l img -> if selected -> traitement
            $file=$request->getUploadedFiles()['img'];

            $validator=new Validator($data);
            $errors=$validator->required('title', 'desc')->getErrors();
            if($errors){
                foreach($errors as $error){
                    $this->toaster->makeToast($error->toString(), Toaster::ERROR);
                }
                return $this->redirect('adminChantier', ["id"=>$id]);
            }


            if($file!=null){
            // traitement img
            $error=$this->fileGuard($file, $id);
            if($error !== true){
                return $error;
            }

            $fileName=$file->getClientFileName();

            $ttesPhotos=$this->photoRepo->findAll();
            foreach($ttesPhotos as $photo){
                if($photo->getImgPath()==$fileName){
                    $this->toaster->makeToast('La photo, identifiée par le nom que vous lui avez donné est déjà sur le serveur', Toaster::ERROR);
                    return $this->redirect('adminChantier', ["id"=>$id]);
                }
            }
            $imgPath=$this->container->get('img.basePath'). DIRECTORY_SEPARATOR .$fileName;
            $file->moveTo($imgPath);
            if(!$file->isMoved()){
                $this->toaster->makeToast("Une erreur s'est produite",Toaster::ERROR);
                return $this->redirect('adminChantier', ["id"=>$id]);
            }
            $vieillePhoto=$chantier->getImgPathChantier();
            $oldPath=$this->container->get('img.basePath').$vieillePhoto;
            unlink($oldPath);
            $chantier->setImgPathChantier($fileName);
            }


            



            $chantier->setNomChantier($data['title'])
                            ->setDateChantier($data['date'])
                            ->setLieu($data['lieu'])
                            ->setDesc($data['desc']);

            $this->manager->persist($chantier);
            $this->manager->flush();

            $this->toaster->makeToast('Chantier modifié avec succès', Toaster::SUCCESS);
            return $this->redirect('adminChantier', ["id"=>$id]);
        }

        return $this->renderer->render('@chantier/updatePresChantier', ["chantier"=>$chantier]);
    }

    /**
     * permet de supprimer un chantier
     *
     * @param ServerRequest $request
     * @return void
     */
    public function deleteChantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);

        $vieillePhoto=$chantier->getImgPathChantier();
        $oldPath=$this->container->get('img.basePath').$vieillePhoto;
        unlink($oldPath);

        // trouver ttes photos liées au chantier et suppr
        $photos=$this->photoRepo->findBy(array('chantier'=>$id));

        foreach($photos as $photo){
            $img=$photo->getImgPath();
            $oldPath=$this->container->get('img.basePath').$img;
            unlink($oldPath);
        }

        $this->manager->remove($chantier);
        $this->manager->flush();

        $this->toaster->makeToast('Chantier supprimé avec succès', Toaster::SUCCESS);
    
        return $this->redirect('adminChantiers');
    }

    /**
     * check si le file ajouté respecte bien ma volonté, taille, type etc
     *
     * @param UploadedFile $file
     * @return void
     */
    public function fileGuard(UploadedFile $file, $id=null){
        if($file->getError()===4){
            $this->toaster->makeToast("Une erreur est survenue lors du chargement", Toaster::ERROR);
            return $this->redirect('adminChantier', ["id"=>$id]);
        }
        list($type, $format)=explode('/', $file->getClientMediaType());

        if(!in_array($type, ['image']) or !in_array($format, ['jpg', 'jpeg', 'png'])){
            $this->toaster->makeToast("Le format de l'image n'est pas accepté, seuls les .png, .jpeg, et .jpg sont acceptés.", Toaster::ERROR);
            return $this->redirect('adminChantier', ["id"=>$id]);
        }

        if($file->getSize()>2047674){
            $this->toaster->makeToast("La taille de l'image doit etre inférieure à 2MO", Toaster::ERROR);
            return $this->redirect('adminChantier', ["id"=>$id]);
        }
        return true;
    }
}