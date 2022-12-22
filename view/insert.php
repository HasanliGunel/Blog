<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
    <link rel="stylesheet" href="../config/assets/css_login/insert.css">

</head>

<body>

    <section class="Form my-4 mx-5">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-20 px-5 pt-3">
                    <h1 class="font-weight-bold py-3">Yeni post əlavə et</h1>
                    <form method="POST" action="../controller/insert.php" enctype="multipart/form-data" class="decor">

                        <div class="form-row">
                            <div class="col-lg-9">
                                <input type="text" placeholder="Post adı" class="form-control my-3 p-2" required name="name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-9 my-3 p-2">
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-9 mb-5">
                                <!-- <input type="text" placeholder="Soyadınız" class="form-control my-3 p-2" required name="work_place"> -->
                                <textarea placeholder="Məzmun..." rows="10" class="form-control" name = "content"></textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-7 mb-3">
                                <button type="submit" class="btn1 mt-3 mb-2" name="insert">Əlavə et</button>
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