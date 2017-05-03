<?php namespace App\Table;
 
use Core\Table\Table;

/**
* Classe Client
*/
class UserTable extends Table
{
   public function findMail($mail)
    {
        return $this->query("SELECT * FROM users WHERE  mail = ? AND valid_at IS NOT NULL" ,[$mail], true);
    } 
}
 