
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS</title>
</head>
<body style="background-color: bisque;">
    <?php
    include("security.php");
    include("welcom.php");
    
    
    ?>

  <center><table border="1" style="background-color: antiquewhite;margin-top: 2em;">
    <tr>
        <th>Firstname</th>
        <th>LastName</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Contact</th>
        <td colspan="2">Decision</td>
    </tr>
  


<?php

include 'con.php';
$sq = "SELECT * FROM student_info";
$res = mysqli_query($con,$sq);
$num_rows = mysqli_num_rows($res);
if ($num_rows>0) {
   

try {
    while($out=mysqli_fetch_assoc($res)){?>
    <tr>

       <td><?php echo  $out ['first_name'];?></td>
       <td><?php echo  $out ['last_name'];?></td>
       <td><?php echo  $out ['email'];?></td>
       <td><?php echo $out ['gender'];?></td>
       <td><?php echo  $out ['contact'];?></td>
       <td><a href="update.php?upd=<?php echo $out['id'];?>">update</a></td>
       <td><a href="delete.php?del=<?php echo $out['id'];?>">Delete</a></td>
    </tr>


<?php
    }



}

catch(mysqli_sql_exception $e) {

    echo "Error: " . $e->getMessage();


}
}else{
    echo "no data in student table";
}
?>
</table>
<a href="home.php">add new student</a>
</center>
<?php include'cop.php'?> 
</body>
</html>