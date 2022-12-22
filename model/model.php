<?php

require_once '../helper/helper.php';
// require_once '../controller/controller.php';
require_once '../config/database.php';

class Model extends Database
{
    protected $database;

    function __construct()
    {
        $this->database = new Database();
    }
    function insertData($data)
    {
        // $pdo = new PDO("mysql:host=localhost;dbname=blog", 'root', '');
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // require_once 'db.php';

        $sql = "INSERT INTO users ( username, name, last_name, work_place, email, phone, password) 
    VALUES (:username, :name, :last_name, :work_place, :email,:phone, :password)";

        $result = $this->database->getConnection()->prepare($sql);
        $result->bindValue(":username", $data["username"], PDO::PARAM_STR);
        $result->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $result->bindValue(":last_name", $data["last_name"], PDO::PARAM_STR);
        $result->bindValue(":work_place", $data["work_place"], PDO::PARAM_STR);
        $result->bindValue(":email", $data["email"], PDO::PARAM_STR);
        $result->bindValue(":phone",  $data["phone"], PDO::PARAM_STR);
        $result->bindValue(":password", $data["password"], PDO::PARAM_INT);

        $result->execute($data);
        return $result;
    }
    // function postData($data){
    //     $sql    = "INSERT INTO post (name, image, content, date) VALUES (:name, :img_name, :content, :date)";

    //     $result = $this->database->getConnection()->prepare($sql);
    //     $result ->bindValue(":name", $data['name'], PDO::PARAM_STR);
    //     $result -> bindValue(":image",$data['image_name'], PDO::PARAM_STR);
    //     $result ->bindValue(":content", $data['content'], PDO::PARAM_STR);
    //     $result ->bindValue(":date", $data['date'], PDO::PARAM_STR);

    //     $result->execute();
    //     return $result;
    // }
   
}
