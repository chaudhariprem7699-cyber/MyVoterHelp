<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include("../includes/db.php");

$totalApplications = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM voter_applications"));
$pending = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM voter_applications WHERE status='Pending'"));
$approved = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM voter_applications WHERE status='Approved'"));
$rejected = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM voter_applications WHERE status='Rejected'"));
$totalMessages = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM contact_messages"));
$totalUsers = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - MyVoterHelp</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#f4f6f9;
}

.header{
background:#0d6efd;
color:#fff;
padding:20px;
text-align:center;
font-size:30px;
font-weight:bold;
}

.sub{
text-align:center;
margin-top:10px;
font-size:20px;
}

.card-container{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
padding:30px;
}

.card{
background:#fff;
border-radius:12px;
padding:25px;
text-align:center;
box-shadow:0 4px 10px rgba(0,0,0,.15);
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
}

.card h3{
margin-bottom:10px;
color:#555;
}

.card h2{
color:#0d6efd;
font-size:35px;
}

.menu{
width:90%;
max-width:900px;
margin:20px auto;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
}

.menu a{
display:block;
text-decoration:none;
background:#fff;
padding:18px;
text-align:center;
border-radius:10px;
font-size:18px;
font-weight:bold;
color:#333;
box-shadow:0 4px 10px rgba(0,0,0,.15);
transition:.3s;
}

.menu a:hover{
background:#0d6efd;
color:#fff;
}

.footer{
text-align:center;
margin:30px;
color:#777;
font-size:14px;
}

</style>

</head>

<body>

<div class="header">
🗳 MyVoterHelp Admin Panel
</div>

<div class="sub">
Welcome Admin 👋
</div>

<div class="card-container">

<div class="card">
<h3>👥 Total Users</h3>
<h2><?php echo $totalUsers; ?></h2>
</div>

<div class="card">
<h3>📝 Applications</h3>
<h2><?php echo $totalApplications; ?></h2>
</div>

<div class="card">
<h3>🟡 Pending</h3>
<h2><?php echo $pending; ?></h2>
</div>

<div class="card">
<h3>🟢 Approved</h3>
<h2><?php echo $approved; ?></h2>
</div>

<div class="card">
<h3>🔴 Rejected</h3>
<h2><?php echo $rejected; ?></h2>
</div>

<div class="card">
<h3>📩 Messages</h3>
<h2><?php echo $totalMessages; ?></h2>
</div>

</div>

<div class="menu">

<a href="users.php">👥 Manage Users</a>

<a href="applications.php">📝 Manage Applications</a>

<a href="manage_contacts.php">📩 Contact Messages</a>

<a href="birthday-mails.php">🎂 Birthday Emails</a>

<a href="settings.php">⚙ Website Settings</a>

<a href="logout.php">🚪 Logout</a>

</div>

<div class="footer">
© <?php echo date("Y"); ?> MyVoterHelp | Admin Dashboard
</div>

</body>
</html>