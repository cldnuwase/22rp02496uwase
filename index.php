<?php
session_start();
include'connections.php';
if(isset($_POST['login'])) {
    $username = $_POST['un'];
    $password = $_POST['pass'];

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $r = mysqli_query($con, $query);

    if(mysqli_num_rows($r) == 1) {
        $out = mysqli_fetch_assoc($r);
        $_SESSION['user_id'] = $out['id'];
        $_SESSION['username'] = $out['username'];
        header("location: home.php");
        exit();
    } else {
        echo"<script>alert('invalid username or passord')</script>";
    }
}
?>


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
        <p style="color: #654B4B;font-family:Monotype Corsiva;font-size:2em;">login form</p>
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
            <td colspan="2"><center><input type="submit"
                                           name="login" 
                                           value="Login"
                                           style="margin-top: 1.5em;
                                                  width: 18em;
                                                  height: 2em;
                                                  border-radius: 0.5em;
                                                  cursor:pointer;"
                                           ></center></td>
        </tr>

    </table>
</form>
<a href="signup.php">Signup</a>
</fieldset>
 </center>
 
</body>
</html>