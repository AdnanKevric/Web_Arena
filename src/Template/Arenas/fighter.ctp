
<html>
<style> <!--This is the css (the design) of the tablee-->
table {
    width:60%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th {
    background-color: black;
    color: white;
}


</style>

<body>

<h3>Welcome to the WebArena <?php echo $myemail;?>!</h3> <!--Title-->
<hr>


<h4>Your avatar</h4>

<?php

echo $this->Html->image('Aragorn-250x250.jpg',array("width"=>"250", "height"=>"250")); //This is the picture/image of the fighters avatar

?>
	 
<hr>
<h4>Your fighters</h4>
<!--The table where all the fighters are shown-->
<table id="t01">

  <tr>

    <th>Fighter name</th> <!--Name of the fighter-->
    <th>Level</th> <!--What level the fighter is on-->
    <th>XP</th> <!--Experience-->
	  <th>Strength</th> <!--Fighter's strength-->
    <th>Maximum Health</th> <!--How much health it's possible to have-->
	  <th>Current Health</th> <!--And how much a fighter has currently-->
    <th>Sight</th> <!--How far the fighter can see on the game bord-->

</tr>

  <?php foreach ($allFighter as $fighter): ?> <!--So, for each fighter in the array-->

    <tr>

        <td> <?php echo $this->Html->link($fighter->name,['controller' => 'Arenas', 'action' => 'vision',$fighter->id,0,0],['condition' => $fighter->player_id == $myid]); //Get the fighter's name by ID
                    
  ?>

        </td>

        <td><?= $fighter->level;
				if(($fighter->xp/4) >= $fighter->level )
				{
					$lvlsUp = (int) ($fighter->xp/4+1-$fighter->level);
					echo " (+" . $lvlsUp . ") ";
				}
		
		?></td> <!--Get fighter's level from database. Shows also if the fighter has enough experience for more levels-->
        <td><?= $fighter->xp?></td> <!--Get fighter's experience from database-->
        <td><?= $fighter->skill_strength;   
				if($fighter->xp/4 >= $fighter->level )
				{
					echo $this->Html->link('Level Up',
									['controller' => 'Arenas', 'action' => 'levelUp',$fighter->id, 1]
                                );
				}
			
		?></td> <!--Get fighter's strength from database. If level up, you can choose to upgrade-->
		    <td><?=  $fighter->skill_health;
				if($fighter->xp/4 >= $fighter->level )
				{
					echo $this->Html->link('Level Up',
									['controller' => 'Arenas', 'action' => 'levelUp',$fighter->id, 2]
                                );
				}
		
		?></td> <!--Get fighter's maximum health from database.If level up, you can choose to upgrade-->
        <td><?= $fighter->current_health?></td> <!--Get fighter's current health from database-->
        <td><?= $fighter->skill_sight;
				if($fighter->xp/4 >= $fighter->level )
				{
					echo $this->Html->link('Level Up',
									['controller' => 'Arenas', 'action' => 'levelUp',$fighter->id, 3]
                                );
				}
		?></td> <!--Get fighter's sight from database. If level up, you can choose to upgrade-->

    </tr>

 <?php endforeach; ?>

</table>
<p>Press the fighters name to enter the arena. If your fighter has enough experience you can choose one of the abilities to level up, by clicking level up (you can only choose one ability per level). </p>
<hr>
<h4>Add a new fighter</h4>

<?php

  echo $this->Form->create('Fighter', array('redirectUrl()' => 'fighter')); //When creating a fighter, redirect to the page fighter
  echo $this->Form->input('name', ['style' => "width: 50%"]); //Where you write a name of the fighter you want to create
  echo $this->Form->hidden('player_id', ['value' => $myid]); //The new fighter get an ID

  //The bord is only (15,10) big 
  $randomX = rand(1,15); 
  $randomY = rand(1,10);
  
  echo $this->Form->hidden('coordinate_x', ['value' => $randomX]); //The fighter gets a random x coordinate between 1 and 15
  echo $this->Form->hidden('coordinate_y', ['value' => $randomY]); //The fighter gets a random xycoordinate between 1 and 10
  echo $this->Form->hidden('level', ['value' => 1]); //As a beginner, the fighter starts at level 1
  echo $this->Form->hidden('xp', ['value' => 0]); //The fighter has none experience
  echo $this->Form->hidden('skill_sight', ['value' => 2]); //And can only see 2 squares from its own standing point
  echo $this->Form->hidden('skill_strength', ['value' => 1]); //Has the lowest strength
  echo $this->Form->hidden('skill_health', ['value' => 3]); //The maximum health is 3
  echo $this->Form->hidden('current_health', ['value' => 3]); //Has the maximum health 
  echo $this->Form->submit(); //Button 
  echo $this->Form->end();

?>



</body>
</html>

