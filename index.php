<?php

require('views/header.php');

if(isset($_GET['team'])){
    require_once('models/database.php');
    $db = databaseConnection();
    if (isset($db)){
        require_once('models/rosterFilled_model.php');
        $rosterFilledDB = new RosterFilled($db);
        if(isset($_GET['inOut']) && isset($_GET['year'])){
            $table_rows = $rosterFilledDB->getSpecificSeason(1, $_GET['inOut'], $_GET['year'], $_GET['s']);
        }else{
            $table_rows = $rosterFilledDB->getSpecificSeason(1, 1, 2017, $_GET['s']);
        }
        require_once('models/athlete_model.php');
        $athletes = new Athlete($db);
        require('views/rosters.php');
    }
    
}elseif(isset($_GET['athlete'])){
    require_once('models/database.php');
	$db = databaseConnection();
    	if (isset($db)){
        require_once('models/result_model.php');
        $result = new Result($db);
        $table_rows = $result->getAthleteResults($_GET['athlete']);
        require_once('models/athlete_model.php');
        $athlete = new Athlete($db);
        $athleteInfo = $athlete->getAthleteInfo($_GET['athlete']);
        $name = $athleteInfo[0]['firstName'] . " " . $athleteInfo[0]['lastName'];
        require_once('models/enterMeet_model.php');
        $enterMeet = new EnterMeet($db);
        require_once('models/meet_model.php');
        $meet = new Meet($db);
        require_once('models/team_model.php');
        $team = new Team($db);
        require_once('models/event_model.php');
        $event = new Event($db);
        require_once('models/season_model.php');
        $season = new Season($db);
        require('views/individual.php');
    }
    
}elseif(isset($_GET['viewMeets'])){
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
	   require('views/meets.php');
	}

}elseif(isset($_GET['meet'])){
    require_once('models/database.php');
    $db = databaseConnection();
    if (isset($db)){
        require_once('models/meet_model.php');
        $meet = new Meet($db);
        $meetInfo = $meet->getMeetInfo($_GET['meet']);
        require_once('models/enterMeet_model.php');
        $enterMeet = new EnterMeet($db);
        $menScore_rows = $enterMeet->getMensScores($_GET['meet']);
        require_once('models/event_model.php');
        $event = new Event($db);
        require_once('models/result_model.php');
        $result = new Result($db);
        $event_rows = $result->getMeetEvents($_GET['meet']);
        require('views/individualMeet.php');
    } 

}elseif(isset($_GET['vip']) && $_SESSION['privileges'] == True){
    require_once('models/database.php');
    $db = databaseConnection();
    if (isset($db)){
    	if(isset($_GET['addMeet'])){
    		require('views/addMeet.php');
    	}else{
        	require('views/vip.php');
    	}
    }

}else {
    require_once('models/database.php');
    $db = databaseConnection();
    if (isset($db)){
        require_once('models/athlete_model.php');
        $athletes = new Athlete($db);
        require_once('models/team_model.php');
        $team = new Team($db);
        $teamID = $team->getTeamID("Medfield");
        require('views/home.php');
    }
}


require('views/footer.php');
