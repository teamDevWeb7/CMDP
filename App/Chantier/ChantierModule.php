<?php
namespace App\Chantier;

use Core\Framework\Router\Router;
use Psr\Container\ContainerInterface;
use App\Chantier\action\ChantierAction;
use Core\Framework\AbstractClass\AbstractModule;
use Core\Framework\Renderer\RendererInterface;

class ChantierModule extends AbstractModule{

    public const DEFINITIONS = __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'Config.php';

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
        $this->router->get('/user/infosChantier/{id:[\d]+}', [$chantierAction, 'chantier'], 'chantier');
        
    }
}