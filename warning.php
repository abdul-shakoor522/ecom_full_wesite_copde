<?php
include "db.php";

$sel1 = "SELECT * FROM cart";
$qry1 = mysqli_query($con, $sel1);

$rows = mysqli_num_rows($qry1);

if($rows > 0){
   
}else{
    header("Location:index.php");
}

