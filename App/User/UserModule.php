<?php
namespace App\User;

use App\User\action\UserAction;
use Core\Framework\AbstractClass\AbstractModule;
use Core\Framework\Renderer\RendererInterface;
use Core\Framework\Router\Router;
use Psr\Container\ContainerInterface;

class UserModule extends AbstractModule{

    public const DEFINITIONS = __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'Config.php';

    private ContainerInterface $container;
    private RendererInterface $renderer;
    private Router $router;

    public function __construct(ContainerInterface $container){

        $userAction=$container->get(UserAction::class);
        
        $this->container=$container;
        $this->router=$container->get(Router::class);
        $this->renderer=$container->get(RendererInterface::class);

        $this->renderer->addPath('user', __DIR__ . DIRECTORY_SEPARATOR . 'view');


        $this->router->get('/user/accueil', [$userAction, 'accueil'], 'accueil');
        $this->router->get('/user/aPropos', [$userAction, 'aPropos'], 'aPropos' );
        $this->router->get('/user/chantiers', [$userAction, 'chantiers'], 'chantiers');
        $this->router->get('/user/contact', [$userAction, 'contact'], 'contact');
        $this->router->post('/user/contact', [$userAction, 'contact']);
        $this->router->get('/user/devis', [$userAction, 'devis'], 'devis');
        $this->router->post('/user/devis', [$userAction, 'devis']);
        $this->router->get('/user/FAQ', [$userAction, 'faq'], 'faq');
        $this->router->get('/user/infosChantier/{id:[\d]+}', [$userAction, 'chantier'], 'chantier');

    }
}