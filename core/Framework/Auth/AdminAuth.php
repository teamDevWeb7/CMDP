<?php
namespace Core\Framework\Auth;

use Model\Entity\Admin;
use Doctrine\ORM\EntityManager;
use Core\Session\SessionInterface;

class AdminAuth{

    private EntityManager $manager;

    private SessionInterface $session;


    public function __construct(EntityManager $manager, SessionInterface $session){
        $this->manager=$manager;
        $this->session=$session;
    }

    public function login(string $email, string $password): bool{
        $admin=$this->manager->getRepository(Admin::class)
            ->findOneBy(["mail"=>$email]);


        // si objet admin pas null et password correspond a celui bdd on ouvre une session admin et on renvoie true
        if($admin && password_verify($password, $admin->getPassword())){
            $this->session->set('auth', $admin);
            $this->setTimestamp();
            return true;
        }
        return false;
    }

    public function logout():void{
        $this->session->delete('auth');
    }

    public function isAdmin():bool{
        // check si co
        if($this->session->has('auth')){
            // instance of permet savoir si instance de l entité admin
            return $this->session->get('auth') instanceof Admin;
        }
        return false;
    }

    /**
     * Vérifie si le timestamp est toujours valide
     * @return bool
     */
    public function checkTimestamp(): bool
    {
        $timestamp = $this->session->get('timestamp');
        if ($timestamp === null) {
            $this->logout();
            return false;
        } elseif ($timestamp > time()) {
            $this->setTimestamp();
            return true;
        }
        $this->logout();
        return false;
    }

    /**
     * Met à jour le timestamp
     * @return void
     */
    private function setTimestamp(): void
    {
        $time = 59;
        $this->session->set('timestamp', time() + $time);
    }
}