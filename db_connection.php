<?php
$hostname='localhost';
$user='lrvelasco';
$pass='7856re';
$db='v2';
$con = new mysqli($hostname,$user,$pass,$db);
if (!mysqli_set_charset($con, "utf8mb4")) {

    printf("Error loading character set utf8mb4: %s\n", mysqli_error($conn));

    exit();

}
if ($con->connect_errno != null) {
   echo "Error número $con->connect_errno conectando a la base de datos.<br>Mensaje: $con->connect_error.";
   exit(); 
}

?>
