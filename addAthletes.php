<?php


    //Connect to database
    require_once('models/database.php');
    $db = databaseConnection();
    
    
    if(isset($db) && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['gradYear']) && isset($_POST['gender'])){
        
        require_once('models/athlete.php');
        $newAthlete = new Athlete($db);
    
        $newAthlete->addAthlete($_POST['firstName'], $_POST['lastName'], $_POST['gradYear'], $_POST['gender']);
        
    }

// Return home
header('Location: ./');
exit();