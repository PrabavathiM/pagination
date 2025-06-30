<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document-DEMO1</title>
</head>
<body>

<?php
$_SESSION["NAME"]="prabavathi";
$_SESSION["AGE"]= 20;
echo "session variables are set";

?>

    
</body>
</html>