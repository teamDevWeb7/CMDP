<?php

use App\Chantier\ChantierModule;
use App\User\UserModule;
use Core\App;
use DI\ContainerBuilder;
use function Http\Response\send;
use GuzzleHttp\Psr7\ServerRequest;
use Core\Framework\Middleware\RouterMiddleware;
use Core\Framework\Middleware\NotFoundMiddleware;
use Core\Framework\Middleware\AdminAuthMiddleware;
use Core\Framework\Middleware\TrailingSlashMiddleware;
use Core\Framework\Middleware\RouterDispatcherMiddleware;


// inclut autoloader de composer
require dirname(__DIR__)."/vendor/autoload.php";

// declare tab modules à charger
$modules = [
    UserModule::class,
    ChantierModule::class

];

// utilisation du builder du container de dependences, builder construit objet container de dep
// != container de dependences
$builder= new ContainerBuilder();
// ajout feuille def principale ds dossier racine
$builder->addDefinitions(dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');


// verif a def et si oui la prend 
// foreach($modules as $module){
//     if(!is_null($module::DEFINITIONS)){
//         // si modules possedent une feuille de config perso, on l ajoute aussi
//         $builder->addDefinitions($module::DEFINITIONS);
//     }
// }

// recup instance container de dep
$container=$builder->build();


// instancie application en lui donnant liste modules et container de dep
$app=new App($container, $modules);

// middlewares
$app->linkFirst(new TrailingSlashMiddleware())
    ->linkWith(new RouterMiddleware($container))
    ->linkWith(new AdminAuthMiddleware($container))
    ->linkWith(new RouterDispatcherMiddleware())
    ->linkWith(new NotFoundMiddleware());


// si l index n est pas exe à partir de la CLI(command Line Interface)
if(php_sapi_name() !== 'cli'){
// recup response en lançant la methode run et en lui passant un objet ServerRequest
// rempli avec ttes les infos de la requete envoyée par la machine client
$response =$app->run(ServerRequest::fromGlobals());
// on renvoi la rep au server apres avoir transformé le retour de l'appli en une reponse comprehensible pour la machine client
send($response);
}

$sitename='Cmydesignprojets';

?>






