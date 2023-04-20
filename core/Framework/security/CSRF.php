<?php

namespace Core\Framework\security;

use Core\Session\SessionInterface;
use Psr\Container\ContainerInterface;

class CSRF{
    private string $sessionKey='_csrf_token';
    private string $formKey='_csrf';

    private SessionInterface $session;


    public function __construct(ContainerInterface $container){
        $this->session=$container->get(SessionInterface::class);
    }

    /**
     * création d'un token et enregistre dans session
     *
     * @return string
     */
    public function generateToken():string{
        // je génére un token de 32 carac que je transforme en hexadecimal ->rend string
        $token=bin2hex(random_bytes(32));
        // enregistre dans tableau de session
        $this->session->setArray($this->sessionKey, $token);
        $this->limitToken();
        return "<input type='hidden' name='{$this->formKey}' value='{$token}'>";
    }

    /**
     * limiter taille enregistrement token si>taille taille+1 ecrasé
     * limite nbr tokens en session
     */
    private function limitToken():void{
        // si rien ds sessionKey on a un tab vide ->eviter erreur
        $tokens=$this->session->get($this->sessionKey, []);
        if(count($tokens)>10){
            array_shift($tokens);
            $this->session->set($this->sessionKey, $tokens);
        }
    }

    /**
     * verifie si token true on l enleve du tableau
     *
     * @param string|null $token
     * @return boolean
     */
    public function checkToken(string $token=null):bool{
        if(!is_null($token)){
            // recup tab tokens, valeur vide si rien
            $tokens=$this->session->get($this->sessionKey, []);
            // prend mon toekn, mon tab de tokens, je verif type et carac
            // renvoie true ou false
            $key=array_search($token, $tokens, true);
            if($key !==false){
                // envoie mauvais token se faire consume
                $this->consumeToken($token);
                return true;
            }
            return false;
        }
        return false;
    }

    public function getFormKey():string{
        return $this->formKey;
    }

    /**
     * consume le token ds le cas ou il n'est pas bon
     * modifie tableau directement pr qu'il soit nettoyé
     *
     * @param string $token
     * @return void
     */
    private function consumeToken(string $token):void{
        // callback, boucle tableau et applique fonction que l'on declare en tant que callback
        $tokens=array_reduce($this->session->get($this->sessionKey, []), function($tok) use ($token){
            // on veut qu'il retourne ts autres tokens que celui passé en param
            if($tok !== $token){
                return $tok;
            }
        }, []);
        // nv tab tokens sans mauavis token remplace ancien tab tokens qui avait mauvais token
        $this->session->set($this->sessionKey, $tokens);
    }





}