<?php

$fname=$lname=$email=$gend=$cont= "";

$fnameErr=$lnameErr=$emailErr=$gendErr=$contErr= "";

if ($_SERVER["REQUEST_METHOD"]== "POST") {
   
    if (empty($_POST["fn"])) {
        $fnameErr = "First name is required";
    } else {
        $fname = test_input($_POST["fn"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $fnameErr = "Only letters and white space allowed";
        }
    }

   
    if (empty($_POST["ln"])) {
        $lnameErr = "Last name is required";
    } else {
        $lname = test_input($_POST["ln"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
            $lnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["em"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["em"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["gender"])) {
        $gendErr = "Gender is required";
    } else {
        $gend = test_input($_POST["gender"]);
    }

    if (empty($_POST["contact"])) {
        $contErr = "Contact is required";
    } else {
        $cont = test_input($_POST["contact"]);
        if (!preg_match("/^[0-9]{10}$/", $cont)) {
            $contErr = "Invalid contact number";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;}
include("con.php");
if (isset($_GET['upd'])) {
    $upd = $_GET['upd'];



    $updsel="SELECT * FROM student_info WHERE id='$upd'";
    $uqs=mysqli_query($con, $updsel);


    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($fnameErr) && empty($lnameErr) && empty($emailErr) && empty($gendErr) && empty($contErr)){
        if(isset($_POST['update'])){
            $fname=$_POST['fn'];
            $lname=$_POST['ln'];
            $email=$_POST['em'];
            $gender=$_POST['gender'];
            $contact=$_POST['contact'];
            try{
                $updatee="UPDATE student_info SET first_name='$fname',last_name='$lname',email='$email',gender='$gender',contact='$contact' WHERE id='$upd'";
                $result=mysqli_query($con,$updatee);
                if($result){
                    echo "<script>alert('Data updated successfully')</script>";
                    header("location:view.php");
                }
                else{
                    echo "<script>alert('Data not updated')</script>";
                }
        
        
            }catch(Exception $e){   
                echo "<script>alert('Data not updated')</script>";
            }
        }
        }

    
}

while($sel=mysqli_fetch_assoc($uqs)){




?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SMS</title>
    <style>

        .error{
            color: red;
        }
    </style>
</head>
<body style="background-color: bisque;">
    <?php
    include"welcom.php";  
    include"security.php";  
    
    ?>
 <center><fieldset style="width: 40%;background-color: antiquewhite;border-bottom: none;border-left: none;border-right: none;margin-top: 5em;border-radius: 0.5em;">
        <legend align="center">Update current student info</legend>
<form method="POST">
    <table border="0">
        <tr>
            <td>FirstName: </td>
            <td><input type="text" 
                       name="fn"
                        
                       placeholder="enter firstname" 
                       style="margin-top: 1em;" 
                       value="<?php echo $sel['first_name'];?>">
                       <span class="error"><?php echo $fnameErr?></span>
                    </td>

        </tr>
        <tr>
            <td>LastName: </td>
            <td><input type="text" 
                       name="ln" 
                       required=""
                       placeholder="enter lastname"  
                       style="margin-top: 1em;"
                       value="<?php echo $sel['last_name'];?>">
                       <span class="error"><?php echo $lnameErr?></span>
                       
                       
                       
                    </td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><input type="text" 
                       name="em" 
                       required=""
                       placeholder="enter email"  
                       style="margin-top: 1em;" 
                       value="<?php echo  $sel['email'];?>">
                       <span class="error"><?php echo $emailErr?></span>
                    </td>
        </tr>
        <tr>
            <td>Gender: </td>
            <td><input type="radio" name="gender" style="margin-top: 1em;" value="female" <?php echo ($sel['gender'] == 'female') ? 'checked' : ''; ?>>Female
                <input type="radio" name="gender" style="margin-top: 1em;" value="male" <?php echo ($sel['gender'] == 'male') ? 'checked' : ''; ?>>Male
                <span class="error"><?php echo $gendErr; ?></span>

            </td>
        </tr>
        <tr>
        <tr>
            <td>Contact: </td>
            <td><input type="text"
                       name="contact" 
                       required=""
                       placeholder="enter tel" 
                       style="margin-top: 1em;" 
                       value="<?php echo  $sel['contact'];?>">
                       <span class="error"><?php echo $contErr?></span>
                       
                    </td>
        </tr>
            <td colspan="2"><center><input type="submit" name="update" value="UPDATE" style="margin-top: 1em;"></center></td>
                            
        </tr>
        
        

    </table>
     </form>   
     </fieldset>
     
    </center>
    <?php include'cop.php'?>
</body>
</html>
<?php


}
?>