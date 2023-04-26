<?php

namespace App\Search;

use Core\Framework\AbstractClass\AbstractModule;
use Core\Framework\Router\Router;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Psr7\ServerRequest;
use Model\Entity\Prospect;
use Psr\Container\ContainerInterface;

class SearchModule extends AbstractModule{
    private ContainerInterface $container;
    private Router $router;
    private $prospRepo;

    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->prospRepo=$this->container->get(EntityManager::class)->getRepository(Prospect::class);

        $this->router=$container->get(Router::class);

        $this->router->get('/ajax/prospect/{needle}', [$this, 'findMesProspects'], 'ajaxProsp');
    }



    // public function findMesProspects(ServerRequest $request){
    //     $data=$request->getAttribute('needle');
    //     // coucou=alias
    //     $results=$this->prospRepo->createQueryBuilder('coucou')
    //     // LIKE DQL
    //                                 ->where('coucou.nom LIKE :needle')
    //                                 ->setParameter(':needle', '%'.$data.'%')
    //                                 ->getQuery()
    //                                 ->getResult();

    //     $reponse='';
    //     $results=array_unique($results, SORT_REGULAR);
    //     foreach($results as $result){
    //         $prospIds=$result->ProspIds();
    //         // $reponse .= '<p><a href="'.$this->router->generateUri('prospect', ['id'=>$id]).">".$result->getNom().'</a></p>';
    //         foreach($prospIds as $id){
    //             $reponse .= '<p><a href="'.$this->router->generateUri('prospect', ['id'=>$id]).">".$result->getNom().'</a></p>';
    //         }


    //     }
    //     return $reponse;
    // }


}