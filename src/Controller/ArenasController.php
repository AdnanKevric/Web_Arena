<?php
namespace App\Controller;
use App\Controller\AppController;
use App\Form\FighterForm;
use Cake\Event\Event;
use Cake\Network\Session;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use App\Model\Table\EventsTable;
use Cake\ORM\TableRegistry;
/**
* Personal Controller
* User personal interface
*
*/
class ArenasController extends AppController
{

public function index()
{

	$this->loadModel('Fighters');
	$fighterlist=$this->Fighters->find('all');
	$testresult = $this->Fighters->test();
	
	$this->set('result', $testresult);
}

public function login() //This is the log in function
{

    if ($this->request->is('post')) {

            $user = $this->Auth->identify(); //This identifies the user

            if ($user) {

                $this->Auth->setUser($user); //The user is logged in
                return $this->redirect($this->Auth->redirectUrl()); //And is redirected to the page
            }

            $this->Flash->error(__('Invalid username or password, try again')); //The user typed in the wrong email or password
    }

}

public function logout() //This is the log out function
    {
        return $this->redirect($this->Auth->logout()); 
    
    }
	
public function levelUp($fighterId, $skill) //this is the level up function
{
	$this->loadModel('Fighters');
	if($skill == 1)
	{
		$this->Fighters->addStrength($fighterId);
	}
	if($skill == 2)
	{
		$this->Fighters->addHealth($fighterId);
	}
	if($skill == 3)
	{
		$this->Fighters->addSight($fighterId);
	}
	return $this->redirect(['action' => 'fighter']);
}


public function fighter()
{

		//Session 
		$session = $this->request->session();
        $myemail= $session->read('Auth.User.email');
        $myid=$session->read('Auth.User.id');
        $this->set('myemail', $myemail); //Sending data from the controller to the view. Now this variables can be accessed in our view
        $this->set('myid', $myid); //Sending data from the controller to the view. Now this variables can be accessed in our view
		

        //The list of all players/fighters by using the ID
        $this->loadModel('Fighters');
        $allFighter=$this->Fighters->allFighters($myid);
        $this->set('allFighter',$allFighter); //Sending data from the controller to the view. Now this variables can be accessed in our view
        $figterlist=$this->Fighters->find('list')
        ->select(['name'])->where(['player_id' => $myid]);	
		

		//Adding a new fighter
		$this->loadModel('Fighters');
        $user = $this->Fighters->newEntity();

        if ($this->request->is('post'))
        {

            $user = $this->Fighters->patchEntity($user, $this->request->data); //Getting all the data 

            if ($this->Fighters->save($user)) //Saving to database
            {

                $this->Flash->success(__("Now you have a new fighter!")); //The fighter was a success
                return $this->redirect(['action' => 'fighter']); //Returning to the fighter page again

            }

            $this->Flash->error(__("Sorry, but you cannot create this fighter. Please try again!")); //Could'nt create the fighter

        }

        $this->set('user', $user); //Sending data from the controller to the view. Now this variables can be accessed in our view
		
}

public function register(){ //This function enables you to create an account
	
	$this->loadModel('Players');
    $user = $this->Players->newEntity();

        if ($this->request->is('post')) 
        {
            $user = $this->Players->patchEntity($user, $this->request->data); //Getting all the data 

            if ($this->Players->save($user)) //Saving to database
            {
                $this->Flash->success(__("The player has been created, you can now log in to play !")); //The account has been created

                return $this->redirect(['action' => 'login']); //Returning to the log in page

            }

            $this->Flash->error(__("Sorry, there has been a mistake! You cannot create this account, please try again!")); //Could'nt create an account
        }

        $this->set('user', $user); //Sending data from the controller to the view. Now this variables can be accessed in our view
	
}

public function attack($attackerId, $defenderName) //function when attacking a another fighter
{
		$this->loadModel('Fighters');
		$this->loadModel('Events');
		$allFighter = $this->Fighters->test();
		
		foreach($allFighter as $fighter){
		
			if($defenderName == $fighter->name)
			{
				$defender=$this->Fighters->get($fighter->id);
				$attacker=$this->Fighters->get($attackerId);
				if(rand(1,20) > ( 10 + ($defender->level)-($attacker->level))){
					
					$defender->current_health -= $attacker->skill_strength;
					$attacker->xp++;
					
					
					if($defender->current_health < 1)
					{
						$attacker->xp += $defender->level;
						$this->Fighters->delete($defender);
						$eventInfo = $attacker->name . " has attacked the fighter " . $defender->name . " and killed him. ";
						$this->Events->saveDiary($eventInfo, $attacker->coordinate_x, $attacker->coordinate_y);
						

						
						
						
						$this->Fighters->save($defender);
						$this->Fighters->save($attacker);	
						$this->Flash->success(__("You attacked the fighter and killed him!"));
						return $this->redirect(['action' => 'vision', $attackerId, 0]);

					}
					else{
						$eventInfo = $attacker->name . " has attacked the fighter " . $defender->name . " and hits. ";
						$this->Events->saveDiary($eventInfo, $attacker->coordinate_x, $attacker->coordinate_y);
						
						$this->Fighters->save($defender);
						$this->Fighters->save($attacker);	
						$this->Flash->success(__("You attacked the fighter and hit!"));
						return $this->redirect(['action' => 'vision', $attackerId, 0]);
					}
					
				}
				else{
					$eventInfo = $attacker->name . " has attacked the fighter " . $defender->name . " but missed. ";
					$this->Events->saveDiary($eventInfo, $attacker->coordinate_x, $attacker->coordinate_y);
					

					$this->Fighters->save($defender);
					$this->Fighters->save($attacker);	
					$this->Flash->success(__("You attacked the fighter but missed!"));
					return $this->redirect(['action' => 'vision', $attackerId, 0]);
				}
					
			}
		
		}
	
}

public function vision($id, $direction) //This function is for the game
{

        //Session
		$session = $this->request->session();
        $myemail= $session->read('Auth.User.email');
        $myid=$session->read('Auth.User.id');

        //Sending data from the controller to the view. Now these variables can be accessed in our view
        $this->set('myemail', $myemail); 
        $this->set('myid', $myid);
		$this->set('id', $id);
		
		
		$this->loadModel('Fighters');
		$this->Fighters->direction($id,$direction);
		
		$test=$this->Fighters->test();
        
        $this->set('test',$test); //Sending data from the controller to the view. Now this variables can be accessed in our view
		$my=$this->Fighters->get($id); //Getting the ID of the fighter

		$this->set('my',$my); //Sending data from the controller to the view. Now this variables can be accessed in our view
		
		
}

public function diary() //This function is the journal of the game
{
	$this->loadModel('events');
        
    $allDiaries=$this->events->allDiaries(); //All the diaries from the database
        
    $this->set('allDiaries',$allDiaries); //Sending data from the controller to the view. Now this variables can be accessed in our view
}



}