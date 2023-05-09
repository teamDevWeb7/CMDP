<?php

namespace App\Search;

use Core\Framework\AbstractClass\AbstractModule;
use Core\Framework\Router\Router;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Psr7\ServerRequest;
use Model\Entity\Chantier;
use Model\Entity\Prospect;
use Psr\Container\ContainerInterface;

class SearchModule extends AbstractModule{
    private ContainerInterface $container;
    private Router $router;
    private $prospRepo;
    private $chantRepo;

    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->prospRepo=$this->container->get(EntityManager::class)->getRepository(Prospect::class);
        $this->chantRepo=$this->container->get(EntityManager::class)->getRepository(Chantier::class);

        $this->router=$container->get(Router::class);

        $this->router->get('/ajax/prospect/{needle}', [$this, 'findMesProspects'], 'ajaxProsp');

        $this->router->get('/ajax/chantier/{needle}', [$this, 'findMesChantiers'], 'ajaxChant');
    }



    public function findMesProspects(ServerRequest $request){
        $data=$request->getAttribute('needle');
        // coucou=alias
        $results=$this->prospRepo->createQueryBuilder('coucou')
        // LIKE DQL
                                    ->where('coucou.nom LIKE :needle')
                                    ->setParameter(':needle', '%'.$data.'%')
                                    ->getQuery()
                                    ->getResult();

        $reponse='';
        $results=array_unique($results, SORT_REGULAR);
        foreach($results as $result){
            $reponse.="<p><a href=".$this->router->generateUri('prospect', ['id'=>$result->getId()]).">".$result->getNom()."</a></p>";
        }
        return $reponse;
    }

    public function findMesChantiers(ServerRequest $request){
        $data=$request->getAttribute('needle');
        // coucou=alias
        $results=$this->chantRepo->createQueryBuilder('cc')
        // LIKE DQL
                                    ->where('cc.nomChantier LIKE :needle')
                                    ->setParameter(':needle', '%'.$data.'%')
                                    ->getQuery()
                                    ->getResult();

        $reponse='';
        $results=array_unique($results, SORT_REGULAR);
        foreach($results as $result){
            $reponse.="<p><a href=".$this->router->generateUri('adminChantier', ['id'=>$result->getId()]).">".$result->getNomChantier()."</a></p>";
        }
        return $reponse;
    }


}