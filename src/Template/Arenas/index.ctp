

<html>
<style>

img{
	
	margin-left: 13%;
}

.button{

	margin-left: 26%;
}

</style>
 <body> 
 
 	<?php

		echo $this->Html->image('Arena-Rex-Review.jpg', array("width"=>"800", "height"=>"200")); 

	?>

	<h2 style = "margin: center; margin-left: 26%"> Welcome to the WebArena</h2> <!--Title-->
	

<?php

	if (!is_null($this->request->session()->read('Auth.User.email'))) { //If the user is logged in, then log out
   		
   		echo $this->Html->link('Logout', array('controller' => 'Arenas', 'action' => 'logout'),['class' => 'button']); 
	
	} 
	else { //If the user has not logged in, then log in or sign up if you have no account
   
    	echo $this->Html->link('Login', array('controller' => 'Arenas', 'action' => 'login'),['class' => 'button']);
    
    	echo $this->Html->link('Sign Up', array('controller' => 'Arenas', 'action' => 'register'),['class' => 'button']);
    
	}
    
?>

	<p style = "width: 50%; margin: auto"> <!--Information about the game-->
	Game play: This is a game where you and other fighters move on a board and fight against each other. A character has three abilitys: Sight, Strength and Health. 
	Sight is the amount of vision you see at the arena. Strength is the amount of damage you make to other opponenets when attacking and health is the amount of hitpoints the fighter can take before dying. As a beginner, the fighter has only a sight of 2 and the lowest strength (1). So, when another fighter is somewhere within your sight, you have the ability to attack your defender. Although, the defender may not die directly. Each time the fighter attacks its defender, the fighter gains point of experience and if the fighter is lucky enough to kill the defender, the fighter will gain as many points of experience as the level of the defender. Every time the fighter has gained 4 points of experience, the fighter has the ability to choose between three things: 
	</p>
	<ul style="margin-left: 26%;">
	<li>1. Level up with 1 point</li>
	<li>2. Gain health with 3 points</li>
	<li>3. Gain sight with 1 point</li>
	</ul>
	<p style="margin-left: 25%;">But when the fighter starts to reach its health points to 0, the fighter will be deleted from this game. 
	</p>
	
	<p style = "width: 50%; margin: auto;"> Create your character and train to become the ultimate warrior in the webarena.
	Are you up for the challenge? </p>



 </body> 
 
</html>


