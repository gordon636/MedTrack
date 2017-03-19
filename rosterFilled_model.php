<?php

class RosterFilled {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    // Safely acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('id_rosterFilled', $this->id_rosterFilled, PDO::PARAM_INT);
        $select->bindParam('id_roster', $this->id_roster, PDO::PARAM_INT);
        $select->bindParam('id_athlete', $this->id_athlete, PDO::PARAM_INT);
        $select->bindParam('captain', $this->captain, PDO::PARAM_INT);
        $select->bindParam('varsity', $this->varsity, PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }

    function getSpecificSeason($id_hs, $inOut, $year, $sex){
        $result = $this->db->prepare("select * from rosterFilled natural join seasons natural join rosters natural join athletes WHERE id_hs = :id_hs and indoorOutdoor = :inOut and year = :year and sex = :sex");
        $result->bindParam(':id_hs', $id_hs, PDO::PARAM_INT);
        $result->bindParam(':inOut', $inOut, PDO::PARAM_INT);
        $result->bindParam(':year', $year, PDO::PARAM_INT);
        $result->bindParam(':sex', $sex, PDO::PARAM_STR);
        $result->execute();
        if(!$result){
            return NUll;
        }
        return $result;
    } 

}