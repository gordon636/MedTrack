<?php

class Team {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    // Safely acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('id_hs', $this->id_hs, PDO::PARAM_INT);
        $select->bindParam('town', $this->town, PDO::PARAM_STR);
        $select->bindParam('league', $this->league, PDO::PARAM_STR);
        $select->bindParam('mascot', $this->mascot, PDO::PARAM_STR);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getTeamName($id_hs){
        return $this->select("select town from team where id_hs = '$id_hs'");
    }

    function getTeamID($town){
        return $this->select("select id_hs from team where town = '$town'");
    }
}