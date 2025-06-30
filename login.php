<?php

session_start();

unset($_SESSION['id']);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    
<!-- form -->
<form action = "" method = "post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="hidden" name ="id">
    <input type="submit" name="login" >
</form>

<!-- php code -->
<?php
// include 'db.php';
ini_set('display_errros',1);
$conn = connect_db();

// $conn = new mysqli("localhost", "root", "", "paganation");
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            
            // $session = true;
            header("Location: profile_image.php");
            exit;

    } else {
        echo "Invalid username or password";
    }


}  


// $conn->close();

?>

</body> 
</html>

