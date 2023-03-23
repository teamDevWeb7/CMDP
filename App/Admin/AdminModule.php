<?php
namespace App\Admin;

use App\Admin\action\AdminAction;
use Core\Framework\Router\Router;
use Psr\Container\ContainerInterface;
use Core\Framework\Renderer\RendererInterface;
use Core\Framework\AbstractClass\AbstractModule;

class AdminModule extends AbstractModule{
    public const DEFINITIONS = __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'Config.php';

    private ContainerInterface $container;
    private RendererInterface $renderer;
    private Router $router;

    public function __construct(ContainerInterface $container){

        $adminAction=$container->get(AdminAction::class);

        $this->container=$container;
        $this->router=$container->get(Router::class);
        $this->renderer=$container->get(RendererInterface::class);

        $this->renderer->addPath('admin', __DIR__ . DIRECTORY_SEPARATOR . 'view');

        $this->router->get('/admin/connectAdmin', [$adminAction, 'connexion'], 'connexion');
        $this->router->get('/admin/accueil', [$adminAction, 'accueilAdmin'], 'accueilAdmin');
        $this->router->get('/admin/tousMesProspects', [$adminAction, 'prospects'], 'prospects');
        $this->router->get('/admin/prospect/{id:[\d]+}', [$adminAction, 'prospect'], 'prospect');
    } 
}