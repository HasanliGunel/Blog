<?php 
session_start();
function isNullPostCheck($data){
    $field = [];
    $result = "";
    foreach($data as $key=>$value){
        if($value == ""){
            $field[] = dictionaryKeys($key);
            $result = implode(",", $field);
        }
    }
    print_r($field);
    if($result == ""){
        $message = true;
    }else{
        $message = "Zəhmət olmasa $result daxil edin.";
    }
    return $message;
    
}

function dictionaryKeys($key){
    $data = [
        "username"       =>  "istifadəçi adı",
        "name"           =>  "adı",
        "last_name"      =>  "soyadı",
        "work_place"     =>  "iş yeri",
        "email"          =>  "e-poçt",
        "phone"          =>  "telefon nömrəsi",
        "password"       =>  "şifrə",
        "confirmPassword"=>  "şifrə təkrarı"
    ];

    return $data[$key];
}

function isNullInsertCheck($data){
    $field = [];
    $result = "";
    foreach($data as $key=>$value){
        if($value == ""){
            $field[] = insertKeys($key);
            $result = implode(",", $field);
        }
    }
    if($result == ""){
        $message = true;
    }else{
        $message = "Zəhmət olmasa $result daxil edin.";
    }
    return $message;
}

function insertKeys($key){
    $data = [
        "name"   =>"postun adı",
        "content"=>"məzmunu"
    ];
    return $data[$key];
}

function isNullInserCheck($data){
    $field = [];
    foreach($data as $key=>$value){
        if($value == ""){
            $field [] = $key;
        }
    }
    return($field);
}

function go ($url,$time){
    // $url = $_SERVER["HTTP_REFERER"];
    if($time!=0){
        header("Refresh:$time,url = $url");
    }else{
        header("Location:$url");
    }
}

function comeback($time){
    $url = $_SERVER["HTTP_REFERER"];
    if($time!=0){
        header("Refresh:$time, url=$url");
    }else{
        header("Location:$url");
    }
}

function phoneRegex($data){

    $phone_pattern = "/ ?+994\s?{50|51|55|07|77}\s?[0-9]{3}\s?[0-9]{2}\s?[0-9]{2}\s?/";
    $message       = "";
    if(preg_match($phone_pattern,$data)){
        $message   = true;
    }else{
        $message   = "Telefon nömrəsini düzgün daxil edin!";
    }
    return $message;
}

function emailRegex($data){
    $email_validation_regex = "/(?:[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+)*|\"(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21\\x23-\\x5b\\x5d-\\x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21-\\x5a\\x53-\\x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])+)\\])/"; 
    $message                = "";
    if(preg_match($email_validation_regex, $data)){
        $message            = true;
    }else{
        $message            = "E-poçt ünvanını düzgün daxil edin!";
    }
    return $message;
}

function emailExist ($data){
    require_once '../config/database.php';
    $database = new Database();
    $select = $database->getConnection()->prepare("SELECT * FROM users WHERE email=?");
    $message = "";
    $select -> execute([$data]);
    if($select->rowCount()>0){
        $message = "Daxil etdiyiniz e-poçt mövcuddur";
    }else{
        $message = true;
    }
    return $message;
}

if(!isset($_POST['token'])){
    $_SESSION['token'] = md5(time().rand(0,9999999));
}


?>