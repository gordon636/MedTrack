<?php

    //Connect to database
    require_once('models/database.php');
    $db = databaseConnection();
    
     
    if(isset($db) && isset($_POST['id_athlete']) && isset($_POST['id_event']) && isset($_POST['performance']) && isset($_POST['place']) && isset($_POST['points']) && isset($_POST['FAT']) && isset($_POST['round'])){


        require_once('models/result.php');
        $newResult = new Result($db);

        if($_POST['FAT'] == "Field Event"){
        	$FAT = 0;
        } elseif($_POST['FAT'] == "Hand Time") {
        	$FAT = 1;
        } else{
        	$FAT = 2;
        }
    
        $newResult->addResult($_POST['id_athlete'], $_POST['id_event'], $_POST['performance'], $_POST['place'], $_POST['points'], $_POST['wind'], $FAT, $_POST['round']);
        
    }

// Return home
header('Location: ./');
exit();