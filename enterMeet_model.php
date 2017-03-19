<?php

class EnterMeet {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    // Safely acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('id_enterMeet', $this->id_enterMeet, PDO::PARAM_INT);
        $select->bindParam('id_meet', $this->id_meet, PDO::PARAM_INT);
        $select->bindParam('id_hs', $this->id_hs, PDO::PARAM_INT);
        $select->bindParam('score', $this->score, PDO::PARAM_INT);
        $select->bindParam('home', $this->home, PDO::PARAM_INT);
        $select->bindParam('sex', $this->sex, PDO::PARAM_STR);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }

    function getEnterMeetInfo($id_meet){
        return $this->select("select * from enterMeet where id_meet = '$id_meet'");
    }

    function getMensScores($id_meet){
        return $this->select("select town, score from enterMeet natural join team WHERE id_meet = '$id_meet' ORDER BY score DESC");
    }

    function countTeams($id_meet){
        $numberOfTeams = $this->select("select DISTINCT id_hs from enterMeet where id_meet = '$id_meet'");
        return (count($numberOfTeams));
    }

    function findHomeTeam($id_meet){
        return $this->select("select id_hs from enterMeet where id_meet = '$id_meet' AND home = 1");
    }

    function findAwayTeam($id_meet){
        return $this->select("select id_hs from enterMeet where id_meet = '$id_meet' AND home = 0");
    }

}