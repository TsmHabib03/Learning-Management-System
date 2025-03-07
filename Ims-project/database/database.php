<?php

$db_server = "localhost";
$db_user = "root";
$db_password = "muning0328";
$db_name = "register";
$conn = "";




try{
    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);
}
catch(mysqli_sql_exception){
    echo "Connection failed";

}   
/*
if($conn){
    echo  "Connected";
}
else{
    echo "Not connected";
}*/
?>