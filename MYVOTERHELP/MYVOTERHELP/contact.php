<?php
include("includes/db.php");

$msg = "";

if(isset($_POST['send'])){

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$message = $_POST['message'];

$sql = "INSERT INTO contact_messages(name,email,mobile,message)
VALUES('$name','$email','$mobile','$message')";

if(mysqli_query($conn,$sql)){
$msg = "Message Sent Successfully!";
}else{
$msg = "Something went wrong!";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Contact Us</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<header>

<div class="logo">
<h2>🗳 MyVoterHelp</h2>
<small>Private Assistance</small>
</div>

<nav>

<a href="index.php">Home</a>
<a href="apply.php">Apply Now</a>
<a href="about.php">About</a>
<a href="contact.php">Contact</a>
<a href="login.php">Login</a>

</nav>

</header>

<div class="register-box">

<h2>Contact Us</h2>

<p style="color:green;"><?php echo $msg; ?></p>

<form method="POST">

<input type="text" name="name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email Address" required>

<input type="text" name="mobile" placeholder="Mobile Number" required>

<textarea name="message" placeholder="Write your message..." rows="5" required></textarea>

<button type="submit" name="send">
Send Message
</button>

</form>

</div>

</body>
</html>