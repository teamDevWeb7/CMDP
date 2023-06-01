<?php
namespace App\Chantier;

use Core\Framework\Router\Router;
use Psr\Container\ContainerInterface;
use App\Chantier\action\ChantierAction;
use Core\Framework\AbstractClass\AbstractModule;
use Core\Framework\Renderer\RendererInterface;

class ChantierModule extends AbstractModule{

    public const DEFINITIONS = __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

    private ContainerInterface $container;
    private Router $router;
    private RendererInterface $renderer;
    

    public function __construct(ContainerInterface $container)
    {
        $chantierAction=$container->get(ChantierAction::class);

        $this->container=$container;
        $this->router=$container->get(Router::class);
        $this->renderer=$container->get(RendererInterface::class);

        $this->renderer->addPath('chantier', __DIR__. DIRECTORY_SEPARATOR.'view');

        $this->router->get('/user/chantiers', [$chantierAction, 'chantiers'], 'chantiers');
        $this->router->get('/user/infosChantier/{id:[\d]+}/{lieu}/{nomC}', [$chantierAction, 'chantier'], 'chantier');
        // :[\p{L}\p{N}\s-]+


        // liste de ts les chantiers avec actions
        $this->router->get('/admin/chantiers', [$chantierAction, 'adminChantiers'], 'adminChantiers');
        // ttes les infos d'un chantier selon ID
        $this->router->get('/admin/infosChantier/{id:[\d]+}', [$chantierAction, 'adminChantier'], 'adminChantier');

        // ajouter un chantier 
        $this->router->get('/admin/addChantier', [$chantierAction, 'addChantier'], 'addChantier');
        $this->router->post('/admin/addChantier', [$chantierAction, 'addChantier']);

        // modifier mon chantier || le remplir qd tt nv
        $this->router->get('/admin/updateChantier/{id:[\d]+}', [$chantierAction, 'updateChantier'], 'updateChantier');
        $this->router->post('/admin/updateChantier/{id:[\d]+}', [$chantierAction, 'updateChantier']);

        // supprimer une photo
        $this->router->get('/admin/deletePhoto/{id:[\d]+}', [$chantierAction, 'deletePhoto'], 'deletePhoto');
        // modif une photo
        $this->router->get('/admin/updatePhoto/{id:[\d]+}', [$chantierAction, 'updatePhoto'], 'updatePhoto');
        $this->router->post('/admin/updatePhoto/{id:[\d]+}', [$chantierAction, 'updatePhoto']);

        // mofifier la présentation du chantier
        $this->router->get('/admin/updatePresentationChantier/{id:[\d]+}', [$chantierAction, 'updatePresChantier'], 'updatePresChantier');
        $this->router->post('/admin/updatePresentationChantier/{id:[\d]+}', [$chantierAction, 'updatePresChantier']);

        $this->router->get('/admin/deleteChantier/{id:[\d]+}', [$chantierAction, 'deleteChantier'], 'deleteChantier');

        
    }
}