<html>
<body>

<table style="border-collapse: separate; border-spacing: 2px; border: solid 10px black; width: 100%; height: 50%;">

	<?php 
		$vertical = array();
		$horizontally = array();
		$visableFighter = array();
		
		
		for ($i = ($my->coordinate_x - $my->skill_sight); $i <= ($my->coordinate_x + $my->skill_sight); $i++)
		{
			array_push($horizontally, $i);
		}
		
		for ($i = ($my->coordinate_y - $my->skill_sight); $i <= ($my->coordinate_y + $my->skill_sight); $i++)
		{
			array_push($vertical, $i);
		}
	?>
	
	<?php $direction=0 ?>

   <?php for($i=1;$i<11;$i++){

        echo"<tr>";

        for($j=1;$j<16;$j++){
           
			
			$myFighter = -1;
			$invisableFighter = -1;
			
			
			foreach ($test as $fighter)
			{
			
				if($fighter->coordinate_x == $j && $fighter->coordinate_y == $i) 
				{
					if($id == $fighter->id)
					{
						$myFighter = $fighter->name;
					
					}
					else{
						$invisableFighter = $fighter->name;

					}
					
				}
				
			}
			
			if(abs($i - $my->coordinate_y) + abs($j - $my->coordinate_x) 
                                <= $my->skill_sight)
								{
									if($myFighter != -1){
											 echo "<td style='background-color:grey; font-size: 60%;'>  $myFighter </td>";
										}
										elseif($invisableFighter != -1){
										
											echo "<td style='background-color:lightGrey; font-size: 60%;'>  $invisableFighter </td>";
											array_push($visableFighter, $invisableFighter);
										}
										else
										{
											 echo "<td style='background-color:lightGrey; font-size: 60%;'> empty </td>";
										}
								}
			
			else{
				if($myFighter != -1){
				 echo "<td style='background-color:grey; font-size: 60%;'>  $myFighter </td>";
				}
				elseif($invisableFighter != -1){
				
					echo "<td style='background-color:pink; font-size: 60%; color: pink'>  $invisableFighter </td>";
				}
				else
				{
					 echo "<td style='background-color:pink; font-size: 60%; color: pink'> empty </td>";
				}
			}
				
			
			
				
        }

        echo "</tr>";

    }
    ?>

</table>

<h4>Attack a player</h4>



<ul>
	<?php 
	
	if(empty($visableFighter))
	{
		echo "<li>Nobody Here</li>";
	}
	?>
	<?php  foreach($visableFighter as $vf): ?>
		
		 <li><?php echo $this->Html->link($vf ,
                                 ['controller' => 'Arenas', 'action' => 'attack',$id, $vf]
                                ); ?></li>
	
	
	
	<?php endforeach; ?>
	
	
	
</ul>  

<hr>
<h4>Move on map</h4>
<?php echo $this->Html->link('Left ',
                                 ['controller' => 'Arenas', 'action' => 'vision',$id,1], array('class' => 'button')
                                );
    ?>
<?php echo $this->Html->link('Up ',
                                 ['controller' => 'Arenas', 'action' => 'vision',$id,2], array('class' => 'button')
                                );
    ?>
<?php echo $this->Html->link('Down ',
                                 ['controller' => 'Arenas', 'action' => 'vision',$id,3], array('class' => 'button')
                                );
    ?>
<?php echo $this->Html->link('Right ',
                                 ['controller' => 'Arenas', 'action' => 'vision',$id,4], array('class' => 'button')
                                );
    

	?>
	
<hr>
<h4>Your fighter</h4>
<table id="t01">
	<tr>
		<th>Fighter name</th>
		<th>Level</th> 
		<th>XP</th>
		<th>Strength</th>
		<th>Maximum Health</th> 
		<th>Current Health</th>
		<th>Sight</th>
	</tr>
	<tr>
		<td><?= $my->name ?></td>
		<td><?= $my->level ?></td>
		<td><?= $my->xp ?></td>
		<td><?= $my->skill_strength ?></td>
		<td><?= $my->skill_health ?></td>
		<td><?= $my->current_health ?></td>
		<td><?= $my->skill_sight ?></td>
	</tr>
	
</table>
	
</body>
</html>