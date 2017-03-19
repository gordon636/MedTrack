<?php 
    require_once('models/database.php');
    $db = databaseConnection();
    if (isset($db)){
        require_once('models/team_model.php');
        $team = new Team($db);
        require_once('models/enterMeet_model.php');
        $enterMeet = new EnterMeet($db);
        require_once('models/meet_model.php');
        $meet = new Meet($db);
        $table_rows = $meet->getAllMeets();
    }
?>

<div class="row col-xs-3">
    <table class="table table-hover">
        <thead>
            <th>Date</th>
            <th>Name</th>
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
            <tr><td>
                <?php 
                    echo $meetInfo[0]['date'];
                ?>
            </td><td>
                <?php 
                    if($numberOfTeams == 2 && $home){
                        $awayTeamID = $enterMeet->findAwayTeam($tr['id_meet']);
                        if(count($awayTeamID) > 0){
                            $awayTeam = $team->getTeamName($awayTeamID[0]['id_hs']);
                            echo "<a href = index.php?meet=". $tr['id_meet'] .">". $awayTeam[0]['town'] . " @ " . $homeTeam[0]['town']."</a>";
                        }
                    } elseif($numberOfTeams > 2){
                        echo "<a href = index.php?meet=". $tr['id_meet'] .">". $meetInfo[0]['name'] ."</a>";
                    }
                ?>
            </td><td>
                <?php 
                ?>
            </td></tr>
            <?php endforeach; ?>
        </tbody>
    </table>