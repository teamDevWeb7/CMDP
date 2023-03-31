<?php
// valider données ex tel champs requis etc


// ce qu'on recup du form dans une var(data)-> $validator=new Validator (data)
// on crée une var erreur -> sur la var $validator on use sa méthode required
// ->required= a chaque clé du tab on verif qu'elle soit remplie
// si une clé pas remplie on use la méthode add Error qui avec le Validator Erreur genere un mess d'aerreur en string
// apres required on ->getErrors renvoie True ou False
// si False on continue le script
//si True on use la methode du Validator error pour afficher le champs manquant

namespace Core\Framework\Validator;


class Validator{
    private array $data;
    private array $errors;
    /**
     * enregistre le tableau de données à valider
     *
     * @param array $data tableau de données(usually il s agit du tab récupéré par $request->getParsedBody)
     */
    public function __construct(array $data){
        $this->data=$data;
    }

    /**
     * reçois un nombre inconnu de var -> traité en tableau mais pas tableau
     * liste les index attendus et obligatoires ds le tab de données
     * @param string ...$keys liste de chaine de carac, "..."->précise attend un nbr indéfinit de values
     * comme ... je ne peux pas donner d autres var à la suite
     *
     * @return self
     */
    public function required(string ...$keys):self{
        foreach($keys as $key){
            // function attend string et tableau à manipuler -> renvoie true ou false -> check si key existe ou non ds tab
            // la condition check qu'aucun champs ne soit vide ou pas rempli
            if(!array_key_exists($key, $this->data) || $this->data[$key]==='' || $this->data[$key]===null){
                $this->addError($key, 'required');
            }
        }
        return $this;
    }

    /**
     * s assure que le mail est valide
     *
     * @param string $key
     * @return self
     */
    public function email(string $key):self{
        // filter_var fonction native permet de check la conformité d'une value en fonction d'un filtre(cf php manual)
        if(!filter_var($this->data[$key], FILTER_VALIDATE_EMAIL)){
            // si rentre ds condition c pas un email
            $this->addError($key, 'email');
        }
        return $this;
    }

    /**
     * on vérifie que le numéro rentré dans le formulaire corresponde à un numéro Français ou Luxembourgeois
     *
     * @param string $key
     * @return self
     */
    // public function tel(string $key):self{
    //     $carac=array(".", " ", "/", "-", "(", ")");
    //     $this->data[$key]=str_replace($carac, "", $this->data[$key]);
    //     $regExp='/^(?:\+33|0)[1-9](?:[\s.-]*\d{2}){4}$|^(?:\+352)?[26]\d{3}(?:[\s.-]*\d{2}){2}$/
    //     ';

    //     // regExp pr num FR et foreign Lux
    //     // ^(?:(?:\+|00)33|0)\s*[1-9]*(\d{2}){4}$|^(?:(?:\+|00)352)\s*(?:[2-7]\d|81)(\d{2}){3}$

    //     // fonctionne pas, ni avec !preg_match, ni avec false... test regExp sur regex101 ct bon
    //     // if(preg_match($regExp ,$this->data[$key])==0){
    //     //     $this->addError($key, 'tel');
    //     // }
    //     return $this;
    // }

    /**
     * enregistre ds tab les erreurs, fonctionne avec le ValidatorError
     *
     * @param string $key
     * @param string $rule
     * @return void
     */
    private function addError(string $key, string $rule):void{
        if(!isset($this->errors[$key])){
            $this->errors[$key]=new ValidatorError($key, $rule);
        }
    }

    /**
     * soit on renvoit un tab rempli des erreurs soit on renvoit rien puisque pas d'erreurs
     * doit etre appelé apres les autres methodes
     *
     * @return array|null
     */
    public function getErrors():?array{
        return $this->errors ?? null;
    }
}