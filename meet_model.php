<?php

class Meet {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    // Safely acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('id_meet', $this->id_meet, PDO::PARAM_INT);
        $select->bindParam('id_track', $this->id_track, PDO::PARAM_INT);
        $select->bindParam('date', $this->date, PDO::PARAM_STR);
        $select->bindParam('weather', $this->weather, PDO::PARAM_STR);
        $select->bindParam('name', $this->name, PDO::PARAM_STR);
        $select->bindParam('id_season', $this->id_season, PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAllMeets(){
        return $this->select("select * from meets ORDER BY id_meet");
    }
    
    function getMeetInfo($id_meet){
        return $this->select("select * from meets where id_meet = '$id_meet'");
    }

}