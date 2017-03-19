<div class="col-xs-9">
    <h1><?php echo $name ?></h1>
        <table class="table table-hover">
        <thead>
        	<th>Date</th>
            <th>Meet</th>
            <th>Season</th>
            <th>Event</th>
            <th>Performance</th>
            <th>Place</th>
            <th>Points</th>
            <th>Round</th>
        </thead>
        
        <tbody>

            <?php foreach($table_rows as $tr): 
            	$home = False;
            	$meetInfo = $meet->getMeetInfo($tr['id_meet']);
            	$numberOfTeams = $enterMeet->countTeams($tr['id_meet']);
            	if($numberOfTeams == 0) {continue;}
            	$homeTeamID = $enterMeet->findHomeTeam($tr['id_meet']);
            	if(count($homeTeamID) > 0){
            		$home = True;
           			$homeTeam = $team->getTeamName($homeTeamID[0]['id_hs']);
           		}
            ?>
            <tr>
            	<td>
            		<?php echo $meetInfo[0]['date']; ?>
            	</td><td>
            		<?php
            		if($numberOfTeams == 2 && $home){
            			$awayTeamID = $enterMeet->findAwayTeam($tr['id_meet']);
            			if(count($awayTeamID) > 0){
            				$awayTeam = $team->getTeamName($awayTeamID[0]['id_hs']);
            				echo "<a href = index.php?meet=". $tr['id_meet'] .">". $awayTeam[0]['town'] . " @ " . $homeTeam[0]['town']."</a>";
            			}
            		} elseif($numberOfTeams > 2){
            			echo $meetInfo[0]['name'];
            		}?>
            	</td><td>
            		<?php
            		$seasonID = $meetInfo[0]['id_season'];
            		$seasonInfo = $season->getSeasonInfo($seasonID);
            		$inOut = ($seasonInfo[0]['indoorOutdoor'] == 0) ? "Outdoor" : "Indoor";
            		echo " " . $inOut . " " . $seasonInfo[0]['year'];
            		?>
            	</td><td>
                	<?php $eventName = $event->getEvent($tr['id_event']);
                	echo $eventName[0]['eventName']; ?>
            	</td><td>
            	    <?php 
                		if($tr['FAT'] == 0){
                			$FATtype = "h";
                		}
                		elseif($tr['FAT'] == 1){
                			$FATtype = "a";
                		}else{ 
                			$FATtype = "m";
                		}

         				if($tr['wind'] != NULL && $tr['wind'] >= 4){
                			echo $tr['performance'] . $FATtype . " (w)"; 
                		}else{
                			echo $tr['performance']. $FATtype;
                		}
                	?>
                </td><td>
                	<?php echo $tr['place']; ?>
                </td><td>
                	<?php echo $tr['points']; ?>
                </td><td>
                	<?php echo $tr['round']; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>