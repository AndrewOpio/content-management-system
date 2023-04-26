<?php
  $server = "localhost";
  $username = "root";
  $password = "";
  //$password = "Power333#";
  $dbname = "smart24tv";
  
  $conn = mysqli_connect($server,$username,$password,$dbname);
  if(!$conn){
    echo "Didnt connect: " .mysqli_error($conn);
   }
?>