<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;


class EventsTable extends Table
{
    
    public function allDiaries(){ //This function returns all the data of diary
        
        $findAll=$this->find('all'); //Finding all the diary
        $all=$findAll->toArray(); //Putting all data in an array
        
        return($all); //Returning everything in the array
    }
    
    
    public function saveDiary($name,$x,$y){
     
        
        $A = TableRegistry::get('event');
		$events = $this->newEntity(); //creates new empty insert
		
		//updates the empty with values
		$events->name = $name;
		$events->date = time::now();
		$events->coordinate_x = $x;
		$events->coordinate_y = $y;
		
		//saves into database
		$this->save($events);          
    }
    
    
    
    
    
}