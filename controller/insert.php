<?php

require_once "../model/model.php";
require_once "../config/database.php";
require_once "../helper/helper.php";

$model    = new Model();
$database = new Database();
if (isset($_POST['insert'])) {

    
    $name       = $_POST['name'];
    $content    = $_POST['content'];

    $img_ex      = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $img_ex_lc   = strtolower($img_ex);

    $img_name     = "photo_" . date('Ymd_His') . "." . $img_ex_lc;

    $imgPath = $_FILES['image']['name'];
    // print_r($img_path); die;
    $img_size     = $_FILES['image']['size'];
    $img_tmp_name = $_FILES['image']['tmp_name'];
    $error        = $_FILES['image']['error'];

    if ($error === 0) {
        if ($img_size > 70000) {

            $message = "Faylın ölçüsü çox böyükdür.";

            header("Location:insert.php?error=$message");
        } else {
            $img_ex      = pathinfo($img_name, PATHINFO_EXTENSION);
            // print_r($img_ex); die;
            $img_ex_lc   = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "phg");

            if (in_array($img_ex_lc, $allowed_exs)) {
                // $new_img_name = uniqid("IMG-", true . "." . $img_ex_lc);
                $destinationFolder = "../picture/";
                // echo "test"; die;
                // print_r($destinationFolder . $img_name); die;
                if (move_uploaded_file($img_tmp_name, $destinationFolder . $img_name)) {

                    // $date       = Date("Y_M_D");
                    //print_r(($date)); die;

                    $sql    = "INSERT INTO post (name, image, content, imgPath) VALUES (?,?,?,?)";

                    $result = $database->getConnection()->prepare($sql);

                    $result->bindValue(":name", $name, PDO::PARAM_STR);
                    $result->bindValue(":img_name", $img_name, PDO::PARAM_STR);
                    $result->bindValue(":content", $content, PDO::PARAM_STR);
                    $result->bindValue(":imgPath", $imgPath, PDO::PARAM_STR);
                    $result = $result->execute([$name, $img_name, $content, $imgPath]);

                    if ($result) {
                        // echo "Məlumat əlavə edildi";
                        header("Location: ../view/main.php");
                    } else {
                        echo "Məlumat əlavə edilmədi";
                    }
                }
            } else {
                $message = "Bu tipdə fayl yükləyə bilməzsiniz!";
                header("Location:insert.php?error = $message");
            }
        }
    }


    // $sql    = "INSERT INTO post (image) VALUES (:new_img_name)";
    // $img_post = $database->getConnection()->prepare($sql);
    // $img_post->bindParam(":image", $new_img_name, PDO::PARAM_STR);
    // // print_r($img_post); die();
    // if($img_post->execute()){
    //     echo "Məlumat əlavə edildi";
    // }else {
    //     echo "Məlumat əlavə edilmədi";
    // }



}
