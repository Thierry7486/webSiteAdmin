<?php
require("./inc/library.php")
?>
<!doctype html>
<html lang="en">
<head>
    <?php include("./parts/head.php") ?>
    <title>About - Hello PHP !</title>
</head>
<body>
    <!-- NavBar -->
    <?php include("./parts/navbar.php") ?>
    <!-- End NavBar -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="text-info text-center my-4">About, Hello PHP !</h1>
            </div>
        </div>
        <div class="row">
            
            <div class="col-12 text-center">
            <p class="text-info text-center">
                    <?=nl2br(readAllTxt("./assets/about/content.txt"));?>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include("./parts/footer.php") ?>
    <!-- End Footer -->
</body>
</html>