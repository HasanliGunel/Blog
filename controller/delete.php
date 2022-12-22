<?php 
require_once "../config/database.php";
$database = new Database();
if(isset($_POST['delete'])){
    $id     = $_POST['delete_id'];
    $sql    = "DELETE FROM post WHERE id=?";
    $stmt   = $database->getConnection()->prepare($sql);
    $result = $stmt->execute([$id]);
    @unlink("../picture/");

    if($result){
        //echo "Post silindi";
        header("Location: ../view/main.php");
    }else{
        echo "Silinmə prosesində xəta var";
    }
}
?>