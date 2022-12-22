<?php 
require_once '../controller/edit.php';
$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$editData = edit($uriSegments[4]);


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Edit</title>
    <link rel="stylesheet" href="<?php $_SERVER['SERVER_NAME'] ?>/new_blog/config/assets/css_login/edit.css">

    
</head>

<body>

    <section class="Form my-4 mx-5">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-20 px-5 pt-3">
                    <h1 class="font-weight-bold py-3">Edit</h1>
                    <form method="POST" action="<?php $_SERVER['SERVER_NAME'] ?>/new_blog/controller/edit.php" enctype="multipart/form-data" class="decor">

                        <div class="form-row">
                            <div class="col-lg-9">
                                <input type="text" class="form-control my-3 p-2" required name="name" value="<?php echo $editData['name'] ?? "" ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-9 my-3 p-2">
                                <input type="hidden" name="hiddenID" value="<?php echo $editData['id'] ?? "" ?>">
                                <img  style = "width: auto; height: 100px; "class="img_edit" src="<?php $_SERVER['SERVER_NAME'] ?>/new_blog/picture/<?php echo $editData["image"] ?? '' ?>" class="img-rounded"> <br><br>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                                
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-9 mb-5">
                               
                                <textarea  rows="10" class="form-control" name="content"><?php echo $editData["content"] ?? ""?></textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-7 mb-3">
                                <button type="submit" class="btn1 mt-3 mb-2" name="update">Edit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>