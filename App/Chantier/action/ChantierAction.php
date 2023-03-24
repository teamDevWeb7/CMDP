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

class ChantierAction{

    use RedirectTrait;

    private ContainerInterface $container;
    private RendererInterface $renderer;
    private Toaster $toaster;
    private Router $router;
    private EntityRepository $chantiersRepo;
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

                // repo photos ? 80% oui
        
    }
    public function chantiers(ServerRequest $request){
        $chantiers=$this->chantiersRepo->findAll();
        return $this->renderer->render('@chantier/chantiersUser', ['siteName' => 'Cmydesignprojets', "chantiers"=>$chantiers]);
    }

    public function chantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);
        if(!$chantier){
            return new Response(404,[], 'Aucun chantier ne correspond');
        }
        return $this->renderer->render('@chantier/infosChantierUser', ['siteName' => 'Cmydesignprojets', "chantier"=>$chantier]);
    }

    public function adminChantiers(ServerRequest $request){
        $chantiers=$this->chantiersRepo->findAll();
        return $this->renderer->render('@chantier/chantiersAdmin', ["chantiers"=>$chantiers]);
    }

    public function adminChantier(ServerRequest $request){
        $id=$request->getAttribute('id');
        $chantier=$this->chantiersRepo->find($id);
        if(!$chantier){
            return new Response(404,[], 'Aucun chantier ne correspond');
        }
        return $this->renderer->render('@chantier/chantierAdmin', ["chantier"=>$chantier]);
    }

    public function addChantier(ServerRequest $request){
        return $this->renderer->render('@chantier/addChantier');
    }

    public function updateChantier(ServerRequest $request){
        return $this->renderer->render('@chantier/updateChantier');
    }
}