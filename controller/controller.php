<?php 
require_once '../model/model.php';
require_once '../helper/helper.php';
require_once '../config/database.php';
$model = new Model();
$database = new Database();
// echo "test"; die;
if (isset($_POST['insert'])) {
    
    $data = [
        "username"        =>  $_POST['username'],
        "name"            =>  $_POST['name'],
        "last_name"       =>  $_POST['last_name'],
        "work_place"      =>  $_POST['work_place'],
        "email"           =>  $_POST['email'],
        "phone"           =>  $_POST['phone'],
        "password"        =>  $_POST['password'],
    ];
    // print_r($data);die;
    if(isNullPostCheck($data) != 1){
        print_r(isNullPostCheck($data));
    }else if(emailExist($data['email']) != 1){
        print_r(emailExist($data['email']));
    }else if(phoneRegex($data['phone']) != 1 ){
        print_r(phoneRegex($data['phone']));
    }elseif(emailRegex($data['email']) != 1){
        print_r(emailRegex($data['email']));
    }else if ($data["password"] != $_POST["confirmPassword"]) {
        echo "Şifrələr eyni deyil!";
        comeback(2);
    }else{
        $data['password'] = md5($data['password']);
        $result = $model->insertData($data);
        //print_r($result);die;
        if ($result) {
           header("Location: ../view/main.php");
        } else {
            echo "Məlumat əlavə edilə bilmədi!";
        }
    }

    // if($_SESSION['Login'] == true){
    //     header("Location:../view/main/index.html");
    // }

    // function exitPage(){
    //     session_start();
    //     session_unset();
    //     session_destroy();
    //     header("Location: ../view/register.php");
    // }
}
