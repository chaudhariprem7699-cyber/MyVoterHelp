<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include("../includes/db.php");
include("../mailer.php");

$id = $_GET['id'];

// Application Details
$result = mysqli_query($conn,"SELECT * FROM voter_applications WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

$name = $row['full_name'];
$email = $row['email'];

// Status Update
mysqli_query($conn,"UPDATE voter_applications SET status='Approved' WHERE id='$id'");

// Approval Email
$html = "

<div style='max-width:650px;margin:auto;font-family:Arial,sans-serif;background:#fff;border:1px solid #ddd;border-radius:10px;overflow:hidden;'>

<div style='background:#28a745;color:#fff;padding:25px;text-align:center;'>

<h1>🎉 Application Approved</h1>

</div>

<div style='padding:30px;'>

<h2>Congratulations ".$name."!</h2>

<p style='font-size:16px;line-height:28px;'>

We are pleased to inform you that your Voter ID application submitted through <b>MyVoterHelp</b> has been successfully approved.

</p>

<p style='font-size:16px;line-height:28px;'>

Our team has completed the verification process.

Thank you for choosing MyVoterHelp.

</p>

<div style='text-align:center;margin:35px;'>

<a href='http://localhost/MYVOTERHELP/login.php'

style='background:#28a745;
color:white;
padding:15px 30px;
text-decoration:none;
border-radius:6px;
font-weight:bold;'>

Login to Your Account

</a>

</div>

<p>

Regards,<br>

<b>Team MyVoterHelp</b>

</p>

</div>

<div style='background:#f5f5f5;padding:15px;text-align:center;font-size:12px;color:#666;'>

Disclaimer:
MyVoterHelp is a private assistance service and is not affiliated with the Election Commission of India.

</div>

</div>

";

sendEmail(
$email,
"🎉 Your Application Has Been Approved",
$html
);

header("Location: applications.php");
exit;
?>