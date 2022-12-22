<?php
require_once "../helper/helper.php";
session_unset();
session_destroy();

header("Location:/new_blog/view/login.php");
?>