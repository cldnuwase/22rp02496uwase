<?php
include'con.php';

if (isset($_GET['del'])) {
   $del=$_GET['del'];
    
   $deldata="DELETE FROM student_info WHERE id='$del'";
   $delq=mysqli_query($con,$deldata);
   header("location:view.php");
}




?>