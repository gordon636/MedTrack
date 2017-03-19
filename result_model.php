<?php

class Result {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    // Safely acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('id_result', $this->id_result, PDO::PARAM_INT);
        $select->bindParam('id_meet', $this->id_meet, PDO::PARAM_INT);
        $select->bindParam('id_event', $this->id_event, PDO::PARAM_STR);
        $select->bindParam('performance', $this->performance, PDO::PARAM_INT);
        $select->bindParam('place', $this->place, PDO::PARAM_INT);
        $select->bindParam('points', $this->points, PDO::PARAM_INT);
        $select->bindParam('wind', $this->wind, PDO::PARAM_INT);
        $select->bindParam('FAT', $this->FAT, PDO::PARAM_INT);
        $select->bindParam('round', $this->round, PDO::PARAM_STR);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function addResult($id_event, $performance, $place, $points, $wind, $FAT, $id_season, $round){
        $insert = $this->db->prepare('insert into results(id_meet, id_event, performance, place, points, wind, FAT, id_season, round) values(1, :id_event, :performance, :place, :points, :wind, :FAT, :round)');
        $insert->bindParam(':id_event', $id_event, PDO::PARAM_STR);
        $insert->bindParam(':performance', $performance, PDO::PARAM_INT);
        $insert->bindParam(':place', $place, PDO::PARAM_INT);
        $insert->bindParam(':points', $points, PDO::PARAM_INT);
        $insert->bindParam(':wind', $wind, PDO::PARAM_INT);
        $insert->bindParam(':FAT', $FAT, PDO::PARAM_INT);
        $insert->bindParam(':round', $round, PDO::PARAM_STR);
        return $insert->execute();
    }


    function getAthleteResults($id_athlete){
        return $this->select("select * from results natural join eventTeam where id_athlete = '$id_athlete' ORDER BY id_result");
    }

    function getMeetEvents($id_meet){
        return $this->select("select DISTINCT eventName, id_event, round from results natural join eventTeam natural join events where id_meet = '$id_meet' ORDER BY weight");
    }

    function getMeetEventResults($id_meet, $id_event, $round){
        return $this->select("select * from results natural join team natural join eventTeam natural join events natural join athletes where id_meet = '$id_meet' AND id_event = '$id_event' AND round = '$round' ORDER BY place");
    }
}