<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Page</title>
</head>
<body>
    
</body>
</html> -->

<?php
session_start();

 unset($_SESSION['username']);
 header("Location: profile_image.php");
 exit;


?>