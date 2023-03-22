<?php
namespace Core\Framework\AbstractClass;


/**
 * un moduel represente un ensemble de pages qui sont chargées d'une responsabilité particulière
 * each module que l on souhaite charger ds l application doit être declarée dans $modules dans /publi/index.php
 */
abstract class AbstractModule{

    /**
     * chemin du fichier de configuration destiné à PHP DI
     */
    public const DEFINITIONS=null;



}







?>