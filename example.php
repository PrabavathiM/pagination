<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination Example</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
        a {
            margin: 0 5px;
            text-decoration: none;
        }
       
    </style>
</head>

<body>

<?php
// Step 1: Connect to the database
$conn = new mysqli("localhost", "root", "", "paganation");

// Step 2: Check connection
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search_string = $_GET['search'];

    $search_sql = "SELECT * FROM `sample` WHERE name='".$search_string."'";
 
    $search_result = $conn->query($search_sql);


    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    


    // var_dump($search_result);
    echo ' ';
    $records_per_page = 10;
   
    // $result = $conn->query($sql);
     $total_sql = "SELECT COUNT(*) AS total FROM sample WHERE name='".$search_string."'";
     $total_result = $conn->query($total_sql);
     $total_row = $total_result->fetch_assoc();
     $total_records = $total_row['total'];

    $total_pages = ceil($total_records / $records_per_page);

    echo "<br>";

    echo "RESULT FOR ".$_GET['search'];
    echo "<br>";
    echo "Total records : ". $total_records;
    echo "<br>";
    echo "Per records : ". $records_per_page;
    echo "<br>";
    echo "Current page: ". $current_page;
    echo "<br>";

    

    if (isset($search_result) && ($search_result->num_rows>0)){
        echo "<br>";
        echo '<table>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>ROLE</th>
        </tr>';

         while ($row = $search_result->fetch_assoc()) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['role']}</td>
            </tr>";
        }
        echo '</table>';

    } else{
        echo "NO data found";
    }


    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i ==  $current_page ) {
            echo "<a>$i</a>";

        } else {
            $var = "<a href='?search=" . $search_string;
            $var .= '&page='.$i;
            $var .= '</a>';
// echo $var;
            echo "<a href='?search=$search_string&page=$i'>$i</a>";
        }
        
    }

} 
else {
    echo '<br>';

    $records_per_page = 10;



    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // if ($current_page < 1) $current_page = 1;

    $offset = ($current_page - 1) * $records_per_page;


    $sql = "SELECT * FROM sample LIMIT $offset, $records_per_page";

    $result = $conn->query($sql);
    $total_sql = "SELECT COUNT(*) AS total FROM sample";
    $total_result = $conn->query($total_sql);
    $total_row = $total_result->fetch_assoc();
    $total_records = $total_row['total'];

    $total_pages = ceil($total_records / $records_per_page);



    echo "<br>";
    echo "Total records : ". $total_records;
    echo "<br>";
    echo "Per records : ". $records_per_page;
    echo "<br>";
    echo "Current page: ". $current_page;
    echo "<br>";


    if ($result && $result->num_rows > 0) {
        echo "<br>";
        echo '<table>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>ROLE</th>
        </tr>';
        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['role']}</td>
            </tr>";
        }
        echo '</table>';

    } else {
        echo "No data found.";
    }

    echo '<br>';


    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
        
            echo "<a>$i</a>";
        } else {
            echo "<a href='?page=$i'>$i</a>";
        }
        
    }

}

$conn->close();

// file upload



    // if (
    //     ($fileext == 'pdf' && $filetype == $pdf)||
    //     ($fileext == 'doc' && $filetype == $doc)||
    //     ($fileext == 'docx' && $filetype == $docx)||
    //     ($fileext == 'xls' && $filetype == $xls) ||
    //     ($fileext == 'xlsx' && $filetype == $xls) ||
    //     ($fileext == 'ppt' && $filetype == $ppt) ||
    //     ($fileext == 'pptx' && $filetype == $pptx)  
    //     )
            






?>


<!-- Searching -->
<form method='get' action="<?php echo $_SERVER['FILE_SELF']?>">
 Search : <input type="text" name='search'>
<button type="submit" >Submit</button>
</form>

<br>


<?php
// file upload



// if (isset($_POST['submit'])){
//     $filename = $_FILES["uploadfile"]["name"];
//     $filetype = $_FILES["uploadfile"]["type"];
//     $filetemp = $_FILES["uploadfile"]["tmp_name"];
//     $fileext = pathinfo($filename, PATHINFO_EXTENSION);

//     $uploaddir = "uploads/";

//      if (!is_dir($uploaddir))    {
//         mkdir($uploaddir);
//     }
//     $size = $_FILES["uploadfile"]["size"];
//     $maxfilesize = 1024*1024;
//     $filename = (string) round(microtime(true) * 1000);
//     $targetfile = $uploaddir.$filename .'.'.$fileext;

    


//     $pdf  = "application/pdf";
//     $doc  = "application/msword";
//     $docx = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
//     $xls  = "application/vnd.ms-excel";
//     $xlsx = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
//     $ppt  = "application/vnd.ms-powerpoint";
//     $pptx = "application/vnd.openxmlformats-officedocument.presentationml.presentation";

//     if (
//         ($fileext == 'pdf' && $filetype == $pdf)||
//         ($fileext == 'doc' && $filetype == $doc)||
//         ($fileext == 'docx' && $filetype == $docx)||
//         ($fileext == 'xls' && $filetype == $xls) ||
//         ($fileext == 'xlsx' && $filetype == $xls) ||
//         ($fileext == 'ppt' && $filetype == $ppt) ||
//         ($fileext == 'pptx' && $filetype == $pptx)  
//         ) {
//             // echo $filetemp;
//             // echo "<br>";
//             // echo $targetfile;
//             if ($size <= $maxfilesize){
//                 if (move_uploaded_file($filetemp, $targetfile)){
//                 echo "successfully file uploaded..";
//             } else {
//                 echo " File move failed";
//             }   
//     } else {
//         echo " file size more than 1MB";
//     }

//     } else{
//         echo "extension error, file can not upload";
//     }
// }
// ?>

</body>
</html>