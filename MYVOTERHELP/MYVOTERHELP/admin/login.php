<?php
session_start();
include("../includes/db.php");

$message="";

if(isset($_POST['login'])){

$username=$_POST['username'];
$password=$_POST['password'];

$query=mysqli_query($conn,"SELECT * FROM admins WHERE username='$username'");

if(mysqli_num_rows($query)>0){

$admin=mysqli_fetch_assoc($query);

if($password == $admin['password']){

$_SESSION['admin']=$admin['username'];

header("Location: dashboard.php");
exit;

}else{

$message="Wrong Password!";

}

}else{

$message="Admin Not Found!";

}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Login</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="register-box">

<h2>Admin Login</h2>

<p style="color:red;"><?php echo $message; ?></p>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

</div>

</body>
</html>