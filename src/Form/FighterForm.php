<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class FighterForm extends Form {
   
    protected function _buildSchema(Schema $schema) 
    {
        return $schema->addField('name', 'string');
    }
      
    protected function _buildValidator(Validator $validator) {
        return $validator->register('name', 
                               'length', 
                               ['rule' => ['minLength', 5],
                                'message' => 'The fighter name is too short']);
    }
    
    protected function _execute(array $data) {
            
        return true; 
        
    }
 }