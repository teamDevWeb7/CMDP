<?php

namespace Core\Framework\security;

use Twig\TwigFunction;
use Core\Framework\security\CSRF;
use Psr\Container\ContainerInterface;
use Twig\Extension\AbstractExtension;


class CSRFTwigExtension extends AbstractExtension{

    private CSRF $csrf;
    
    public function __construct(ContainerInterface $container){
        $this->csrf=$container->get(CSRF::class);
    }

    public function getFunctions(){
        return[
            // 1 nomme fonction, 2 lier function existante
            new TwigFunction('csrf', [$this, 'generateToken'], ['is_safe'=>['html']])
        ];
    }

    public function generateToken():string{
        // on prend methode créée ds objet CSRF
        return $this->csrf->generateToken();
    }

}