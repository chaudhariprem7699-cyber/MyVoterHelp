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

// Update Status
mysqli_query($conn,"UPDATE voter_applications SET status='Rejected' WHERE id='$id'");

// Rejection Email
$html = "

<div style='max-width:650px;margin:auto;font-family:Arial,sans-serif;background:#ffffff;border:1px solid #ddd;border-radius:10px;overflow:hidden;'>

<div style='background:#dc3545;color:#ffffff;padding:25px;text-align:center;'>

<h1>Application Update</h1>

</div>

<div style='padding:30px;'>

<h2>Hello ".$name.",</h2>

<p style='font-size:16px;line-height:28px;'>

Thank you for choosing <b>MyVoterHelp</b>.

After reviewing your application, we are unable to proceed with it at this time.

</p>

<p style='font-size:16px;line-height:28px;'>

This may happen because some information or documents are incomplete or require correction.

You are welcome to submit a new application with the correct details.

</p>

<div style='text-align:center;margin:35px;'>

<a href='http://localhost/MYVOTERHELP/apply.php'
style='background:#dc3545;
color:white;
padding:15px 30px;
text-decoration:none;
border-radius:6px;
font-weight:bold;'>

Apply Again

</a>

</div>

<p>

If you need any assistance, please contact our support team.

</p>

<p>

Regards,<br>

<b>Team MyVoterHelp</b>

</p>

</div>

<div style='background:#f5f5f5;padding:15px;text-align:center;font-size:12px;color:#666;'>

Disclaimer:<br>

MyVoterHelp is a private assistance service and is not affiliated with or endorsed by the Election Commission of India.

</div>

</div>

";

sendEmail(
    $email,
    "Application Status Update - MyVoterHelp",
    $html
);

header("Location: applications.php");
exit;
?>