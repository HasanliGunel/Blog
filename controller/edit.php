<?php
require_once "../config/database.php";
$database = new Database();

$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// print_r($uriSegments); die;

function edit($editId){
    $database = new Database();
    if($editId != null){
        $id = $editId;
        $sql = "SELECT *FROM post WHERE id=:id LIMIT 1";
        $stmt = $database->getConnection()->prepare($sql);
        $data = [':id'=> $id];
        $stmt->execute($data);
        $editData = $stmt->fetch(PDO::FETCH_ASSOC);
        // extract($editData);
    }

    return $editData;
}
    
    
    if(isset($_POST['update'])){
        $name         = $_POST['name'] ?? "";
        $content      = $_POST['content'] ?? "";
        $img_ex       = pathinfo($_FILES['image']['name'] ?? "", PATHINFO_EXTENSION) ?? "";
        $img_ex_lc    = strtolower($img_ex) ?? "";
        $img_name     = "photo".date("Ymd_His"). ".". $img_ex_lc ?? "";
        $img_size     = $_FILES['image']['size'] ?? "";
        $img_tmp_name = $_FILES['image']['tmp_name'] ?? "";
        $error        = $_FILES['image']['error'] ?? ""; 
        // echo $name;die;
        $sql = "SELECT image FROM post WHERE id=:id LIMIT 1";
        $stmt = $database->getConnection()->prepare($sql);
        $data = [':id'=> $_POST['hiddenID']];
        $stmt->execute($data);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($error === 0){
            if($img_size >70000){
                echo "Faylın ölçüsü çox böyükdür.";
            }else{
                $allowed_exs = ["jpg","jpeg", "png"];
                
                if(in_array($img_ex_lc, $allowed_exs)){
                    $destinationFolder = "D:\\php\\htdocs\\new_blog\\picture\\";
                    //  print_r($destinationFolder); die;
                    $image = $destinationFolder.$result['image'];
                    $result = unlink($image);
                    // print_r($result); die;
                    move_uploaded_file($img_tmp_name,$destinationFolder.$img_name);
                    $id = $_POST['hiddenID'];
                    $sql  = "UPDATE post SET `name` = '$name', `image` = '$img_name' ,`content` = '$content'  WHERE `id` = '$id'";
                    
                    // $stmt->bindParam(":id",       $_POST['hiddenID'], PDO::PARAM_STR);
                    // $stmt->bindParam(":name",    $name,    PDO::PARAM_STR);
                    // $stmt->bindParam(":image",   $img_name,PDO::PARAM_STR);
                    // $stmt->bindParam(":content", $content, PDO::PARAM_STR);
                    $stmt = $database->getConnection()->prepare($sql);
                    $result = $stmt->execute();
                    if($result){
                        
                        // print_r($_SERVER['SERVER_NAME']."/new_blog/view/main.php"); die;
                        header('Location: /new_blog/view/main.php');
                    }else{
                        die('error');
                    }
                }
            }
        }
    }
    ?>
