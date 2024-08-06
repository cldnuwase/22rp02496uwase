<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SMS</title>
</head>
<body style="background-color: #2a2a2a;">

 <center><fieldset style="width: 30%;background-color: antiquewhite;border-bottom: none;border-left: none;border-right: none;margin-top: 23em;border-radius: 0.5em;">    
        <legend align="center" ></legend>
        <p style="color: #654B4B;font-family:Monotype Corsiva;font-size:2em;">Sign up form</p>
<form method="POST">
    <table border="0" style="margin-bottom: 4em;">
        <tr>
            <td>Username: </td>
            <td><input type="text" 
                       name="un" 
                       required=""
                       placeholder="enter Username" 
                       style="margin-top: 1.5em;">
                    </td>

        </tr>
        <tr>
            <td>Password: </td>
            <td><input type="password" 
                       name="pass" 
                       required="" 
                       placeholder="enter password"  
                       style="margin-top: 1.5em;">
                    </td>
        </tr>
        <tr>
            <td>Confirm-Password: </td>
            <td><input type="password" 
                       name="cpass" 
                       required="" 
                       placeholder="enter password"  
                       style="margin-top: 1.5em;">
                    </td>
        </tr>
        <tr>
            <td colspan="2"><center><input type="submit"
                                           name="signup" 
                                           value="Signup"
                                           style="margin-top: 1.5em;
                                                  width: 18em;
                                                  height: 2em;
                                                  border-radius: 0.5em;
                                                  cursor:pointer;"
                                           ></center></td>
        </tr>

    </table> <p>Already have an account? <a href="index.php">Log in</a></p>
</form>
</fieldset>
 </center>

</body>
</html>

<?php
include'connections.php'; 
if(isset($_POST['signup'])){
   $un=$_POST['un'];
    $pass=$_POST['pass'];
    $cpass=$_POST['cpass'];
    
    $check_username = "SELECT * FROM `user` WHERE `username` = '$un'";
    $result = mysqli_query($con, $check_username);
    
    if(mysqli_num_rows($result) > 0){
        echo "<script>alert('Username already exists. Please choose a different username.');</script>";
    } else {
        if($pass == $cpass){
            $sql = "INSERT INTO `user`(`username`, `password`) VALUES ('$un','$pass')";
            $result = mysqli_query($con, $sql);
            
            if($result){
                echo "<script>alert('Signup Successful');</script>";
            } else {
                echo "<script>alert('Signup Failed');</script>";
            }
        } else {
            echo "<script>alert('Password and Confirm Password do not match');</script>";
        }
    }
}

?>