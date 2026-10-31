<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/db.php';
include 'mailer.php';

$message = "";

if(isset($_POST['register'])){

    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password != $confirm_password){

        $message = "Passwords do not match!";

    }else{

        $check = mysqli_query($conn,"SELECT id FROM users WHERE email='$email'");

        if(mysqli_num_rows($check)>0){

            $message = "Email already exists!";

        }else{

            $hash = password_hash($password,PASSWORD_DEFAULT);

            $sql="INSERT INTO users(full_name,email,mobile,date_of_birth,password)
            VALUES('$full_name','$email','$mobile','$dob','$hash')";

            if(mysqli_query($conn,$sql)){

                $result = sendEmail(

                    $email,

                    "Welcome to MyVoterHelp",

                    "

                    <div style='font-family:Arial;padding:20px;'>

                    <h2 style='color:#0d6efd;'>

                    Welcome ".$full_name." 🎉

                    </h2>

                    <p>Your account has been created successfully.</p>

                    <p>You can now login and apply for your New Voter ID.</p>

                    <br>

                    <a href='http://localhost/MYVOTERHELP/login.php'
                    style='background:#0d6efd;
                    color:white;
                    padding:12px 20px;
                    text-decoration:none;
                    border-radius:5px;'>

                    Login Now

                    </a>

                    <br><br>

                    <p>Thank you for choosing MyVoterHelp ❤️</p>

                    </div>

                    "

                );

                header("Location: login.php?success=1");
                exit;

            }else{

                $message = "Registration Failed!";

            }

        }

    }

}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>User Registration</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="register-box">

<h2>Create Account</h2>

<p style="color:red;"><?php echo $message; ?></p>

<form method="POST">

<input type="text" name="full_name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email Address" required>

<input type="text" name="mobile" placeholder="Mobile Number" required>

<input type="date" name="dob" required>

<input type="password" name="password" placeholder="Password" required>

<input type="password" name="confirm_password" placeholder="Confirm Password" required>

<button type="submit" name="register">

Register

</button>

</form>

<br>

<p>

Already have an account?

<a href="login.php">

Login

</a>

</p>

</div>

</body>

</html>