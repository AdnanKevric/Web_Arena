<?php
namespace App\Model\Table;
use Cake\ORM\Table;


class FightersTable extends Table {
    

	public function allFighters($myid)
	{
        $query=$this->find('all')->where(['player_id' => $myid])->order(['id'=> 'ASC']); //Find all the fighters in the correct order

        $allFighter=$query->toArray(); //Put all the founded fighters in an array
            
        return($allFighter); //Returning all the fighters
	}
	
	public function direction($id,$direction){ 
            
            if($direction!=0 ){ //The direction cannot be 0 if the fighters/players are going to move. If the direction is 0, the fighter/player will stand still
                
                    $fighter=$this->get($id); //Get the ID fighters ID
            
                  if($direction==1 && $fighter->coordinate_y>0) $fighter->coordinate_x--; //This direction goes left
                  if($direction==2 && $fighter->coordinate_x>0) $fighter->coordinate_y--; //This direction goes down
                  if($direction==3 && $fighter->coordinate_x<14) $fighter->coordinate_y++; //This direction goes up
                  if($direction==4 && $fighter->coordinate_y<9) $fighter->coordinate_x++; //This direction goes right
            
                $this->save($fighter); //Saving to database
            }  
        }
	
	public function test() //This function find all the fighters and returns them
	{
		$query=$this->find('all'); //Find fighters
		$test=$query->toArray(); //Put them in an array
		return($test); //And return the fighters
		
	}
	
	public function getFighter($id)
	{
		$result = $this->get($id);
		return($result);
		
	}
	
	public function addStrength($fighterId)
	{
		$fighter = $this->get($fighterId);
		$fighter->level++;
		$fighter->skill_strength++;
		$this->save($fighter);
	}
	
	public function addHealth($fighterId)
	{
		$fighter = $this->get($fighterId);
		$fighter->level++;
		$fighter->skill_health += 3;
		$fighter->current_health = $fighter->skill_health;
		$this->save($fighter);
	}
	
	public function addSight($fighterId)
	{
		$fighter = $this->get($fighterId);
		$fighter->level++;
		$fighter->skill_sight++;
		$this->save($fighter);
	}
	
}
		


