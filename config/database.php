<?php
Class Database{
    private $servername  = "localhost";
    private $db_username = "root";
    private $db_psw      = "";
    private $db_name     = "blog";
    private $db_table    = "users";
    private $pdo;
    
    function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->servername;dbname=blog", $this->db_username, $this->db_psw);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Failed:" . $e->getMessage();
        }
    }

    public function getConnection(){
        return $this->pdo;
      }
    
}



?>