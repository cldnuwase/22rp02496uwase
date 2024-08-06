<?php

$con = mysqli_connect("localhost","root","","student_management_system");
if(!$con){
    die("connection failed : ".mysqli_connect_error());
}
?>