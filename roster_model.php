<?php

class Roster{
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    // Safely acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('id_roster', $this->id_roster, PDO::PARAM_INT);
        $select->bindParam('id_hs', $this->id_hs, PDO::PARAM_INT);
        $select->bindParam('id_season', $this->id_season, PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getRosterID($id_hs, $id_season){
        return $this->select("select id_roster from rosters WHERE id_season = '$id_season' AND id_hs = '$id_hs'");
    }
 

}