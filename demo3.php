<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document-DEMO3</title>
</head>
<body>

<?php

session_unset();

session_destroy();

echo "all session variable, session destroyed:))"
?>
    
</body>
</html>