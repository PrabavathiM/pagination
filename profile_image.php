    <?php
    session_start();

    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {

        echo "u are valid one okay conntinue";
    } else {
        echo "u ar not valid request. unautrozed.pls login again";
        exit;
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Image</title>

        <style>
            .profile {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                object-fit: cover;
                border: 10px;
                position: absolute;
                margin-top: 50px;
                top: 5px;
                right: 10px;
            }
        </style>
    </head>

    <body>

        <!-- file upload  -->

        <br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

            <label for="fileselect"> select file to upload</label>
            <input type="file" name="uploadfile" required>

            <input type="submit" name="submit" value="submit">
        </form>

        <!-- image upload in php -->
        <?php



$conn = connect_db();

        // $conn = new mysqli("localhost", "root", "", "paganation");
        // if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }


        $user_id = $_SESSION['id'];

        function image_preview($conn, $user_id)
        {
            $sql_display_img = "SELECT profile_image FROM users WHERE id = '$user_id' ";
            $result = $conn->query($sql_display_img);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $profile_img = $row['profile_image'];

                if (!empty($profile_img)) {
                    echo "<img src='$profile_img' width='200px' height='200px'>";
                } else {
                    echo "no image set";
                }
            }
        }


        if (isset($_POST['submit']) && isset($_FILES['uploadfile'])) {

            $filename = $_FILES["uploadfile"]["name"];
            $filetype = $_FILES["uploadfile"]["type"];
            $filetemp = $_FILES["uploadfile"]["tmp_name"];
            $fileext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            $uploaddir = "uploads/";

            if (!is_dir($uploaddir)) {
                mkdir($uploaddir);
            }
            $size = $_FILES["uploadfile"]["size"];
            $maxfilesize = 1024 * 1024;
            $filename = (string) round(microtime(true) * 1000);
            $targetfile = $uploaddir . $filename . '.' . $fileext;

            $F_extension = [
                "jpg"  => "image/jpeg",
                "jpeg"  => "image/jpeg",
                "png"  => "image/png",
                "webp" => "image/webp"
            ];

            if ($F_extension[$fileext] && $filetype == $F_extension[$fileext]) {

                if ($size <= $maxfilesize) {
                    if (move_uploaded_file($filetemp, $targetfile)) {
                        echo "successfully file uploaded..";

                        // store file path in db
                        $sql_add_img_path = " UPDATE users SET profile_image='$targetfile' WHERE id  = '$user_id'";
                        if ($conn->query($sql_add_img_path)) {
                            echo "<br> image path stored in database";
                        } else {
                            echo "<br> failed to store image path";
                        }

                    } else {
                        echo " File move failed";
                    }
                } else {
                    echo " file size more than 1 MB so can not upload the file";
                }
            } else {
                echo "check the file extension you are not upload correct file extension file";
            }
        }

        // echo image_preview($conn, $user_id);
        image_preview($conn, $user_id);
        // $conn->close();
        ?>

        <br>
        <a href='login.php'>logout</a>

    </body>

    </html>