<?php
namespace Core\bdd;


use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;


// config présente sur la doc du fournisseur de bundle

class DatabaseFactory{
    public function __invoke(ContainerInterface $container):?EntityManager{
        $paths=[dirname(__DIR__, 2). DIRECTORY_SEPARATOR.'model/entity'];
        $isDevMode=$container->get("doctrine.devMode");
        $dbparams=[
            "driver"=>$container->get("doctrine.driver"),
            "user"=>$container->get("doctrine.user"),
            "password"=>$container->get("doctrine.mdp"),
            "dbname"=>$container->get("doctrine.dbname"),
            "driverOptions"=>[
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            ]
        ];

        $config=ORMSetup::createAnnotationMetadataConfiguration($paths, $isDevMode);

        try{
            $conn=DriverManager::getConnection($dbparams);
            return EntityManager::create($conn, $config);
        }catch(\Exception $e){
            echo "[ERREUR] : ". $e->getMessage();
            die;
        }
    }
}





?>