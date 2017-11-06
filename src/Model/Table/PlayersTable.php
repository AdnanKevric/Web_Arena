<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Query;

class PlayersTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
        
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required');
            
            
    }

}

?>