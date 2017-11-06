

<h1>Events occured in the last 24 hours!</h1> <!--Title-->

<!--The table for the diary-->
<table style="border-collapse: separate; border-spacing: 1px; border: solid 10px pink; width: 50%; height: 50%;">


    <tr>
        <th>Event </th> <!--The information of what has happended-->
        <th>Coordinate x,y</th> <!--The fighters coordinates-->
        <th>Date</th> <!--And when it happened-->
       
    </tr>

 <?php foreach ($allDiaries as $event): ?> <!--So, for each diary -->
    <?php if (strtotime($event->date) >= (time() - 86400)) {
				?>
	<tr>
        
            <td><?= $event->name?></td> <!--Get all the information from the database-->
            <td><?= $event->coordinate_x ?>,<?= $event->coordinate_y?></td> <!--Get the fighters coordinates from the database-->
            <td><?= $event->date?></td> <!--And get the date from the database-->
            <?php
			}?>
 <?php endforeach; ?>
</table>