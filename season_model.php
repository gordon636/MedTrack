<?php

class Season {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    // Safely acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('id_season', $this->id_seson, PDO::PARAM_INT);
        $select->bindParam('indoorOutdoor', $this->indoorOutdoor, PDO::PARAM_INT);
        $select->bindParam('year', $this->year, PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getSeasonInfo($id_season){
        return $this->select("select * from seasons where id_season = '$id_season'");
    }

    function getSeasonID($inOut = null, $year){
        return $this->select("select id_season from seasons where indoorOutdoor = '$inOut' AND year = '$year'");
    }
}