<!doctype html>
<html lang="en">
<head>
    <meta name="theme-color" content="#272b30" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="vendors/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="vendors/jquery.min.js"></script>
    <script src="vendors/popper.min.js"></script>
    <script src="vendors/bootstrap.min.js"></script>
    <title>Local Share</title>
</head>
<body>

<?php
session_start();
if(isset($_POST["submit"])) {
    $target_dir = "storage/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    if (file_exists($target_file)) {
        $_SESSION["file_exists"] = "The file " . basename($_FILES["fileToUpload"]["name"]) . " already exists.";
        $uploadOk = 0;
    }
    // if everything is ok, try to upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $_SESSION["success"] = "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<?php
if(isset($_SESSION["success"])) {
    ?>
    <div class="alert alert-success alert-dismissible fixed-alert">
        <button type="button" class="close no-focus" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <?php echo $_SESSION["success"] ?>
    </div>
    <?php
    unset($_SESSION["success"]);
}
?>

<?php
if(isset($_SESSION["file_exists"])) {
    ?>
    <div class="alert alert-danger alert-dismissible fixed-alert">
        <button type="button" class="close no-focus" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> <?php echo $_SESSION["file_exists"] ?>
    </div>
    <?php
    unset($_SESSION["file_exists"]);
}
?>

<div class="container-fluid full-page-wrapper">

    <div class="btn-group">
        <button type="button" class="btn btn-success no-focus" data-toggle="modal" data-target="#myModal">UPLOAD</button>
        <a type="button" class="btn btn-primary no-focus" href="storage">DOWNLOAD</a>
    </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">

                <form class="upload-form" action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <button type="submit" class="btn btn-primary no-focus" name="submit">Upload</button>
                </form>

            </div>

        </div>
    </div>
</div>
</body>
</html>
