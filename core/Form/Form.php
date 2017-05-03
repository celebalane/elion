<?php
namespace Core\Form;

/**
* Classe Verification Formulaire
*/

class Veriform
{
    public function __construct($post)
    {
        $this->datas = $post;
    }


    public function getValue($key)
    {
        if(isset($this->datas[$key])){
            return $this->datas[$key];
        }
        return null;
    }


    public function isAlph($key, $message)                 //Verif caractère alphanumérique
    {
        $value = $this->getvalue($key);
        if(empty($value) || !preg_match('/^[a-zA-Z0-9_]+$/', $value)){
            $this->msgError($key, $message);
            return false
        }
        return true;
    }


    public function isMail($key, $message)                 //Verif mail
    {
        $value = $this->getvalue($key);
        if(empty($value) || !filter_var($value, FILTER_VALIDATE_EMAIL)){
            $this->msgError($key ,$message);
            return false;
        }    
        return true;
    }
        
    public function verifPassword($key, $message){

        if(empty($post['password']) || $post['password']!=$post['password_confirm']){
            $this->msgError($key, $message);
            return false;
        }
        return true;
    }

    public function msgError($post, $message)
    {
        return $_SESSION['flash']['danger'][$post] = $message;
    }

}