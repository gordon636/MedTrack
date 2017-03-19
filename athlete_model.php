<?php

class Athlete {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    // Safely acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('id_athlete', $this->id_athlete, PDO::PARAM_INT);
        $select->bindParam('id_HS', $this->id_HS, PDO::PARAM_INT);
        $select->bindParam('firstName', $this->firstName, PDO::PARAM_STR);
        $select->bindParam('lastName', $this->lastName, PDO::PARAM_STR);
        $select->bindParam('gradYear', $this->gradYear, PDO::PARAM_INT);
        $select->bindParam('gender', $this->gender, PDO::PARAM_STR);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Attempt to add post
    function addAthlete($firstName, $lastName, $gradYear, $gender){
        $insert = $this->db->prepare('insert into athletes(id_HS, firstName, lastName, gradYear, gender) values(1, :firstName, :lastName, :gradYear, :gender)');
        $insert->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $insert->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $insert->bindParam(':gradYear', $gradYear, PDO::PARAM_INT);
        $insert->bindParam(':gender', $gender, PDO::PARAM_STR);
        return $insert->execute();
    }
    
    function getAllTimeRoster($team_name){
        require_once('models/database.php');
        $db = databaseConnection();
        if (isset($db)){
            require_once('models/team.php');
            $teamdb = new Team($db);
            $team = $teamdb->getTeamID($team_name);
            $team = $team[0]['id_hs'];
            return $this->select("select * from athletes where id_HS= '$team' ORDER BY gradYear DESC");
        } else {
            return "Sorry, could not connect to database.";
        }
    }

    function getAthleteInfo($id_athlete){
        return $this->select("select * from athletes where id_athlete = '$id_athlete'");
    }

}