<?php

class GoogleUser {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    // Safely acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('id', $this->id, PDO::PARAM_INT);
        $select->bindParam('email', $this->email, PDO::PARAM_STR);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function checkPrivileges($email){
        $rows = $this->select("select * from `googleUsers` where email = '$email'");
        return (count($rows));
    }

}