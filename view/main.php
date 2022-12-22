<?php
require_once '../helper/validation.php';
require_once '../helper/helper.php';
require_once '../config/database.php';
// print_r($_SESSION);
$database = new Database();

if (!$_SESSION['Login']) {
    header("Location:/new_blog/view/login.php");
}
//print_r($_SESSION['Login']); die;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css"> <!-- https://fontawesome.com/ -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- https://fonts.google.com/ -->

    <link rel="stylesheet" href="../config/assets/css_profile/css/bootstrap.min.css">
    <link rel="stylesheet" href="../config/assets/css_profile/css/templatemo-video-catalog.css">
    <!--

TemplateMo 552 Video Catalog

https://templatemo.com/tm-552-video-catalog

-->
    <style>
        img {
            height: 300px !important;
            width: 450px !important;
        }
    </style>
</head>

<body>
    <div class="tm-page-wrap mx-auto">
        <div class="position-relative">
            <div class="position-absolute tm-site-header">
                <div class="container-fluid position-relative">
                    <div class="row">
                        <div class="col-5 col-md-8 ml-auto mr-0">
                            <div class="tm-site-nav">
                                <nav class="navbar navbar-expand-lg mr-0 ml-auto" id="tm-main-nav">
                                    <button class="navbar-toggler tm-bg-black py-2 px-3 mr-0 ml-auto collapsed" type="button" data-toggle="collapse" data-target="#navbar-nav" aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span>
                                            <i class="fas fa-bars tm-menu-closed-icon"></i>
                                            <i class="fas fa-times tm-menu-opened-icon"></i>
                                        </span>
                                    </button>
                                    <div class="collapse navbar-collapse tm-nav" id="navbar-nav">
                                      
                                        <ul class="ml-auto navbar-nav text-uppercase">
                                            <li class="nav-item">
                                                <?php if (($_SESSION['user_type']) === "admin") : ?>

                                                    <a class="nav-link tm-nav-link" href="../view/insert.php" name="post">Əlavə et</a>

                                                <?php endif ?>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link tm-nav-link" href="../controller/exit.php">Çıxış</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tm-welcome-container text-center text-white">
                <div class="tm-welcome-container-inner">
                    <p class="tm-welcome-text mb-1 text-white">Welcome <?php echo $_SESSION['username'] ?></p>

                </div>
            </div>

            <div id="tm-video-container">
                <video autoplay muted loop id="tm-video">
                    <!-- <source src="video/sunset-timelapse-video.mp4" type="video/mp4"> -->

                    <source src="../config/assets/css_profile/video/wheat-field.mp4" type="video/mp4">
                </video>
            </div>

            <i id="tm-video-control-button" class="fas fa-pause"></i>
        </div>

        <div class="container-fluid">
            <div id="content" class="mx-auto tm-content-container">
                <main>
                    <div class="row">
                        <!-- <div class="col-12">
                            <h2 class="tm-page-title mb-4">Our Video Catalog</h2>
                            <div class="tm-categories-container mb-5">
                                <h3 class="tm-text-primary tm-categories-text">Categories:</h3>
                                <ul class="nav tm-category-list">
                                    <li class="nav-item tm-category-item"><a href="#"
                                            class="nav-link tm-category-link active">All</a></li>
                                    <li class="nav-item tm-category-item"><a href="#"
                                            class="nav-link tm-category-link">Drone Shots</a></li>
                                    <li class="nav-item tm-category-item"><a href="#"
                                            class="nav-link tm-category-link">Nature</a></li>
                                    <li class="nav-item tm-category-item"><a href="#"
                                            class="nav-link tm-category-link">Actions</a></li>
                                    <li class="nav-item tm-category-item"><a href="#"
                                            class="nav-link tm-category-link">Featured</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->

                        <div class="row tm-catalog-item-list">
                            <?php
                            $sql = "SELECT * FROM post";
                            $stmt = $database->getConnection()->prepare($sql);
                            $result = $stmt->execute();

                            while ($row = $stmt->fetch()) {
                                // $imageURL = '../picture/'.$row["imgPath"];
                            ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 tm-catalog-item">
                                    <div class="position-relative tm-thumbnail-container">

                                        <img src="<?php echo "../picture/" . $row['image'] ?>" alt="<?php $row['image'] ?>" class="img-fluid tm-catalog-item-img">

                                    </div>
                                    <div class="p-4 tm-bg-gray tm-catalog-item-description">
                                        <h3 class="tm-text-primary mb-3 tm-catalog-item-title"><?php echo $row['name'] ?></h3>
                                        <p class="tm-catalog-item-text"><?php echo $row['content'] ?></p>


                                        <?php if (($_SESSION['user_type']) === "admin") : ?>
                                            <div class="card-body text-right ">
                                                <div class="row">
                                                    <form method="GET" action="../view/edit.php/<?php echo $row['id']; ?>">
                                                        <input type="submit" value="Edit" class="navbar-toggler tm-bg-black py-2 px-3 mr-0 ml-auto collapsed mr-4">
                                                    </form>

                                                    <form method="POST" action="../controller/delete.php">
                                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                        <input type="submit" name="delete" value="Sil" class="navbar-toggler tm-bg-black py-2 px-3 mr-0 ml-auto collapsed">
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endif ?>

                                        

                                    </div>
                                </div>
                            <?php } ?>





                        </div>

                        <!-- Catalog Paging Buttons -->

                </main>

                <!-- Subscribe form and footer links -->
                <div class="row mt-5 pt-3">
                    <div class="col-xl-6 col-lg-12 mb-4">
                        <div class="tm-bg-gray p-5 h-100">
                            <h3 class="tm-text-primary mb-3">Do you want to get our latest updates?</h3>
                            <p class="mb-5">Please subscribe our newsletter for upcoming new videos and latest
                                information about our
                                work. Thank you.</p>
                            <form action="" method="GET" class="tm-subscribe-form">
                                <input type="text" name="email" placeholder="Your Email..." required>
                                <button type="submit" class="btn rounded-0 btn-primary tm-btn-small">Subscribe</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-4">
                        <div class="p-5 tm-bg-gray">
                            <h3 class="tm-text-primary mb-4">Quick Links</h3>
                            <ul class="list-unstyled tm-footer-links">
                                <li><a href="#">Duis bibendum</a></li>
                                <li><a href="#">Purus non dignissim</a></li>
                                <li><a href="#">Sapien metus gravida</a></li>
                                <li><a href="#">Eget consequat</a></li>
                                <li><a href="#">Praesent eu pulvinar</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-4">
                        <div class="p-5 tm-bg-gray h-100">
                            <h3 class="tm-text-primary mb-4">Our Pages</h3>
                            <ul class="list-unstyled tm-footer-links">
                                <li><a href="#">Our Videos</a></li>
                                <li><a href="#">License Terms</a></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Privacy Policies</a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- row -->

                <footer class="row pt-5">
                    <div class="col-12">
                        <p class="text-right">Copyright 2020 The Video Catalog Company

                            - Designed by <a href="https://templatemo.com" rel="nofollow" target="_parent">TemplateMo</a></p>
                    </div>
                </footer>
            </div> <!-- tm-content-container -->
        </div>

    </div> <!-- .tm-page-wrap -->


    <script src="../config/assets/css_profile/js/jquery-3.4.1.min.js"></script>
    <script src="../config/assets/css_profile/js/bootstrap.min.js"></script>
    <script>
        function setVideoSize() {
            const vidWidth = 1920;
            const vidHeight = 1080;
            let windowWidth = window.innerWidth;
            let newVidWidth = windowWidth;
            let newVidHeight = windowWidth * vidHeight / vidWidth;
            let marginLeft = 0;
            let marginTop = 0;

            if (newVidHeight < 500) {
                newVidHeight = 500;
                newVidWidth = newVidHeight * vidWidth / vidHeight;
            }

            if (newVidWidth > windowWidth) {
                marginLeft = -((newVidWidth - windowWidth) / 2);
            }

            if (newVidHeight > 720) {
                marginTop = -((newVidHeight - $('#tm-video-container').height()) / 2);
            }

            const tmVideo = $('#tm-video');

            tmVideo.css('width', newVidWidth);
            tmVideo.css('height', newVidHeight);
            tmVideo.css('margin-left', marginLeft);
            tmVideo.css('margin-top', marginTop);
        }

        $(document).ready(function() {
            /************** Video background *********/

            setVideoSize();

            // Set video background size based on window size
            let timeout;
            window.onresize = function() {
                clearTimeout(timeout);
                timeout = setTimeout(setVideoSize, 100);
            };

            // Play/Pause button for video background      
            const btn = $("#tm-video-control-button");

            btn.on("click", function(e) {
                const video = document.getElementById("tm-video");
                $(this).removeClass();

                if (video.paused) {
                    video.play();
                    $(this).addClass("fas fa-pause");
                } else {
                    video.pause();
                    $(this).addClass("fas fa-play");
                }
            });
        })
    </script>
</body>

</html>