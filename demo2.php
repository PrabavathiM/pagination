<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document-DEMO2</title>
</head>
<body>
<?php 
echo "name : ".$_SESSION["NAME"]."<br>";
echo "age : ".$_SESSION["AGE"]."<br>";
$_SESSION["AGE"]=24;

echo "age : ".$_SESSION['AGE']."<BR>"; 

print_r($_SESSION);

?>
</body>
</html>