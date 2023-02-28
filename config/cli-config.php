<?php

//Ce fichier permet de configurer l'accès au entitées et au manager dans la CLI(console)
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// a partir index on initialise tout
require dirname(__DIR__) . '/public/index.php';


if (isset($app)) {
    $container = $app->getContainer();
    // Récupération du manager

    
    $entityManager = $container->get(EntityManager::class);
    $commands = [
    ];

    ConsoleRunner::run(
        new SingleManagerProvider($entityManager),
        []
    );
}




?>