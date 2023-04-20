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

        // connexion
        $this->router->get('/admin/connectAdmin', [$adminAction, 'connexion'], 'connexion');
        $this->router->post('/admin/connectAdmin', [$adminAction, 'connexion']);
        $this->router->get('/admin/deconnecte', [$adminAction, 'deco'], 'deco');

        // accueil
        $this->router->get('/admin/accueil', [$adminAction, 'accueilAdmin'], 'accueilAdmin');

        // gestion prospect
        $this->router->get('/admin/tousMesProspects', [$adminAction, 'prospects'], 'prospects');
        $this->router->get('/admin/prospect/{id:[\d]+}', [$adminAction, 'prospect'], 'prospect');
        $this->router->get('/admin/prospect/delete/{id:[\d]+}', [$adminAction, 'deleteProspect'], 'deleteProspect');
        $this->router->get('/admin/updateProspect/{id:[\d]+}', [$adminAction, 'updateProspect'], 'updateProspect');
        $this->router->post('/admin/updateProspect/{id:[\d]+}', [$adminAction, 'updateProspect']);

        // devis
        $this->router->get('/admin/tousMesDevis', [$adminAction, 'pageDevis'], 'pageDevis');
        $this->router->get('/admin/devis/delete/{id:[\d]+}', [$adminAction, 'deleteDevis'], 'deleteDevis');
        // $this->router->get('/admin/devis/{id:[\d]+}', [$adminAction, 'voirDevis'], 'voirDevis');
        // soluc gpt
         $this->router->get('/admin/pdf/{filename:[\da-zA-Z\.\-\_]+}',[$adminAction, 'affichePdf'], 'affichePdf');

        // messagesconnectAdmin
        $this->router->get('/admin/tousMesMessages', [$adminAction, 'pageMessages'], 'pageMessages');
        $this->router->get('/admin/tousMesMessages/delete/{id:[\d]+}', [$adminAction, 'deleteMess'], 'deleteMess');
    } 
}