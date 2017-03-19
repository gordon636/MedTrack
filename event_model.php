<?php

class Event {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    // Safely acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('id_event', $this->id_event, PDO::PARAM_STR);
        $select->bindParam('eventName', $this->eventName, PDO::PARAM_STR);
        $select->bindParam('relay', $this->relay, PDO::PARAM_INT);
        $select->bindParam('type', $this->type, PDO::PARAM_STR);
        $select->bindParam('weight', $this->weight, PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getEvent($id_event){
        return $this->select("select eventName from events where id_event = '$id_event'");
    }
    

}