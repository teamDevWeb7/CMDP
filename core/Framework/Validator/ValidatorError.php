<?php
namespace Core\Framework\Validator;

class ValidatorError{

    private string $key;
    private string $rule;

    private array $message=[
        'required'=>"<my-p class='lang' key='required'>Le champs '%s' est requis</my-p>",
        'email'=>"<my-p class='lang' key='email'>Le champs '%s' doit être un email valide</my-p>",
        'tel'=>"Le champs '%s' doit être un numéro valide provenant de France ou du Luxembourg"
    ];

    public function __construct(string $key, string $rule){
        $this->key=$key;
        $this->rule=$rule;
    }

    /**
     * transforme l'objet en chaine de caractère pour pouvoir afficher
     *
     * @return string
     */
    public function toString():string{
        if(isset($this->message[$this->rule])){
            if($this->key === 'mdp'){
                // sprintf function affichage attend format string et ce qui doit être inséré =>%s
                return sprintf($this->message[$this->rule], 'mot de passe');
            }if($this->key === 'mail'){
                return sprintf($this->message[$this->rule], 'adresse mail');
            }if($this->key === 'tel'){
                return sprintf($this->message[$this->rule], 'numéro de téléphone');
            }else{

                return sprintf($this->message[$this->rule], $this->key);
            }
        }
        return $this->rule;
    }
}










?>