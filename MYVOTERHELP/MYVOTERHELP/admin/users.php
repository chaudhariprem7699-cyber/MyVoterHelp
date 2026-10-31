<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include("../includes/db.php");

$result=mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Manage Users | MyVoterHelp</title>

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
color:white;
padding:22px;
text-align:center;
box-shadow:0 2px 8px rgba(0,0,0,.2);
}

.header h1{
font-size:34px;
}

.header p{
margin-top:8px;
font-size:18px;
}

.container{
width:95%;
margin:30px auto;
}

.card{
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,.12);
overflow-x:auto;
}

table{
width:100%;
border-collapse:collapse;
min-width:900px;
}

th{
background:#0d6efd;
color:white;
padding:14px;
}

td{
padding:12px;
border-bottom:1px solid #ddd;
text-align:center;
white-space:nowrap;
}

tr:hover{
background:#f8f9fa;
}

.back-btn{
display:inline-block;
margin-top:20px;
background:#0d6efd;
color:white;
padding:12px 22px;
text-decoration:none;
border-radius:6px;
font-weight:bold;
}

.back-btn:hover{
background:#084298;
}

.footer{
text-align:center;
margin:40px;
color:#666;
font-size:14px;
}

</style>

</head>

<body>

<div class="header">

<h1>👥 MyVoterHelp Admin Panel</h1>

<p>Registered Users</p>

</div>

<div class="container">

<div class="card">

<h2 style="margin-bottom:20px;">👥 Registered Users</h2>

<table>

<tr>

<th>ID</th>

<th>Full Name</th>

<th>Email</th>

<th>Mobile</th>

<th>Date of Birth</th>

<th>Registration Date</th>

</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['mobile']; ?></td>

<td><?php echo date("d M Y",strtotime($row['date_of_birth'])); ?></td>

<td><?php echo date("d M Y",strtotime($row['created_at'])); ?></td>

</tr>

<?php
}
?>

</table>

<br>

<a href="dashboard.php" class="back-btn">

⬅ Back to Dashboard

</a>

</div>

</div>

<div class="footer">

<p>

© 2026 <b>MyVoterHelp</b> | Admin Dashboard

</p>

<br>

<p>

<strong>Disclaimer:</strong>

MyVoterHelp is a private assistance service and is not affiliated with the Election Commission of India.

</p>

</div>

</body>

</html>