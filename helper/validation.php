<?php 
require_once '../model/model.php';
require_once '../helper/helper.php';
require_once '../config/database.php';
$database = new Database();

// print_r($_SESSION); die;
// echo "test";

    if(isset($_POST['login'])){
        $data = [
            "username"        =>  $_POST['username'],
            "password"        =>  $_POST['password'],
        ];
        // print_r($data); die;
        // if($_SESSION['token']){
        //     die('Token tapılmadı');
        // }
    
        // if($_SESSION['token']!=$_POST['token']){
        //     die("Daxil olmaq üçün icazəniz yoxdur")
        // }


        if(!isset($_POST['token'])){
            die('Token tapılmadı');
        };

        if($_POST['token']!= $_SESSION['token']){
            die("Daxil olmaq üçün icazəniz yoxdur");
        };


        $_SESSION['Login'] = "false";
        $query = $database->getConnection()->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $query ->execute(array($data['username'],$data['password']));
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $control = $query->rowCount();
        // print_r($control); die;
        $_SESSION['user_type'] = $row['user_type']?? ""; 
        //print_r($_SESSION['user_type']); die;
        if(!($control > 0)){
            echo "<center>İstifadəçi adı və ya şifrə səhvdi</center>";
        }else {
            if($row['user_type'] == 'admin'){
                // echo "true"; die;
                // $_SESSION['user_type'] = $row['user_type'];
                // echo $_SESSION['user_type'];
                session_regenerate_id(true);
                $_SESSION['Login']     = "true";
                $_SESSION['username']  = $data['username'];
                $_SESSION['LoginIP']   = $_SERVER['REMOTE_ADDR'];
                $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                // print_r($_SESSION['Login']); die;
                
                // header('Location: ../view/main.php');
               
            }else{
                session_regenerate_id(true);
                $_SESSION['Login']     = "true";
                $_SESSION['username']  = $data['username'];
                $_SESSION['LoginIP']   = $_SERVER['REMOTE_ADDR'];
                $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                // header("Location: ../view/main.php");
            }
            
            
        }
        
        if($_SESSION['Login'] == "true"){
            header("Location:/new_blog/view/main.php");
        }
    
    
        //print_r($_SESSION['Login']); die;
        
    }

// print_r($_SESSION['Login']); die;
