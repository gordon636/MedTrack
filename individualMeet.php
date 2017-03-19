<div class="col-xs-3">
    <h1><?php echo $meetInfo[0]['name'] . " : " .  $meetInfo[0]['date'] ?></h1>
        <table class="table table-hover">
	        <thead>
	        	<th>Rank</th>
	        	<th>Team</th>
	        	<th>Score</th>
	        </thead>
	        <tbody>
	        	<?php 
	        		$rank = 1;
	        		foreach($menScore_rows as $tr):
	        	?>
	        	<tr> 
	        		<td>
	        			<?php echo $rank;
	        				$rank++;
	        			?>	
	        		</td><td>
	        			<?php echo $tr['town'];?>
	        		</td><td>
	        			<?php echo $tr['score']; ?>
	        		</td>
	        	</tr>
	        		<?php endforeach; ?>
	        </tbody>	
	    </table>
	    <?php foreach($event_rows as $event):
	    	$result_rows = $result->getMeetEventResults($_GET['meet'], $event['id_event'], $event['round']);
	    ?>
		    <h4> <?php echo $event['eventName'] . " " . $event['round'];?></h4>
		    <table class="table table-hover">
		    	<thead>
		        	<th>Place</th>
		        	<th>Name</th>
		        	<th>Team</th>
		        	<th>Performance</th>
		        	<th>Points</th>
		        </thead>
		        <tbody>
		        	<?php 
		        		$place = 1;
		        		foreach($result_rows as $tr):?>
		        	<tr>
		        		<td> <?php echo $place;
		        				$place++;?>
		        		</td><td><?php echo $tr['firstName'] . " " . $tr['lastName'];?>
		        		</td><td><?php echo $tr['town'];?>
		        		</td><td><?php echo $tr['performance'];?>
		        		</td><td><?php echo $tr['points'];?>
		        		</td>
		        	</tr>
		        <?php endforeach; ?>
		        </tbody>
		    </table>
		<?php endforeach; ?>