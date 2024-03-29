<?php

use Core\bdd\DatabaseFactory;
use Core\Framework\Renderer\TwigRendererFactory;
use Core\Framework\Router\Router;
use Core\Framework\Renderer\RendererInterface;
use Core\Framework\Router\RouterTwigExtension;
use Core\Framework\security\CSRFTwigExtension;
use Core\Framework\TwigExtensions\AssetsTwigExtension;
use Core\Session\PHPSession;
use Doctrine\ORM\EntityManager;
use Core\Session\SessionInterface;
use Core\toaster\Toaster;
use Core\toaster\ToasterTwigExtension;

return [
    // info BDD
    "doctrine.user"=>"root",
    "doctrine.dbname"=>"cmdp",
    "doctrine.mdp"=>"",
    "doctrine.driver"=>"pdo_mysql",
    "doctrine.devMode"=>true,

    // chemin default des views
    "config.viewPath"=>dirname(__DIR__).DIRECTORY_SEPARATOR.'view',
    'img.basePath'=>dirname(__DIR__).DIRECTORY_SEPARATOR.'public'. DIRECTORY_SEPARATOR. 'assets' . DIRECTORY_SEPARATOR.'imgs'. DIRECTORY_SEPARATOR.'chantiers' . DIRECTORY_SEPARATOR,
    'pdf.basePath'=>dirname(__DIR__).DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'Admin'.DIRECTORY_SEPARATOR.'pdfs'.DIRECTORY_SEPARATOR ,
    "twig.extensions"=>[
        RouterTwigExtension::class,
        ToasterTwigExtension::class,
        AssetsTwigExtension::class,
        CSRFTwigExtension::class
    ],
    Router::class=>\DI\create(),//instancie si pas instance sinon redonne instance deja existante
    RendererInterface::class=>\DI\factory(TwigRendererFactory::class),
    EntityManager::class=>\DI\factory(DatabaseFactory::class),//factory dit à DI que ce qu elle appelle doit construire un autre et on veut recup l instance qui arrive au final
    SessionInterface::class=>\DI\get(PHPSession::class),//demande sessioninterface mais on attend PHPsession
    Toaster::class=>\DI\autowire()//resout dependences
];

// PHP DI objet complet pas besoin réadapter
//  PHP DI gestionnaire dependences sou sforme tableau PHP
//  peux use class comme clé et action comme valeur, PHP DI fait tout tout seul

?>