<?php

use Doctrine\ORM\EntityManager;
use Model\Entity\Admin;

include dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'index.php';


if($app){
    $container=$app->getContainer();
    $manager=$container->get(EntityManager::class);
    $admin=new Admin();
    $admin->setName('Admin')
        ->setMail('test@test.fr')
        ->setPhone('0606060606')
        ->setPassword(password_hash('admin', PASSWORD_BCRYPT));

    $manager->persist($admin);
    $manager->flush();
    echo "Admin enregistré";
}

// a executer dans le terminal



// clé secrete communication entre site et service re CAPTCHA
// 6LfpX-ckAAAAAN9NuwK9BKuWBfPekgenk1TinPU6