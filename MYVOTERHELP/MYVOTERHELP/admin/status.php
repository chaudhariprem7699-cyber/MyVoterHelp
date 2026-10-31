<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

include("../includes/db.php");

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,"SELECT * FROM voter_applications WHERE user_id='$user_id' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>My Application Status | MyVoterHelp</title>

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
padding:20px;
text-align:center;
}

.header h1{
font-size:32px;
}

.container{
width:95%;
max-width:1100px;
margin:30px auto;
}

.card{
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 4px 10px rgba(0,0,0,.15);
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

th{
background:#0d6efd;
color:white;
padding:14px;
}

td{
padding:14px;
text-align:center;
border-bottom:1px solid #ddd;
}

tr:hover{
background:#f9f9f9;
}

.pending{
background:#fff3cd;
color:#856404;
padding:6px 12px;
border-radius:20px;
font-weight:bold;
}

.approved{
background:#d1e7dd;
color:#0f5132;
padding:6px 12px;
border-radius:20px;
font-weight:bold;
}

.rejected{
background:#f8d7da;
color:#842029;
padding:6px 12px;
border-radius:20px;
font-weight:bold;
}

.btn{
display:inline-block;
margin-top:25px;
padding:12px 22px;
background:#0d6efd;
color:white;
text-decoration:none;
border-radius:6px;
font-weight:bold;
}

.btn:hover{
background:#084298;
}

.footer{
text-align:center;
margin:40px;
color:#666;
}

</style>

</head>

<body>

<div class="header">

<h1>🗳 MyVoterHelp</h1>

<p>My Application Status</p>

</div>

<div class="container">

<div class="card">

<h2>📋 My Voter Applications</h2>

<table>

<tr>
<th>ID</th>
<th>Full Name</th>
<th>Email</th>
<th>City</th>
<th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['city']; ?></td>

<td>

<?php

if($row['status']=="Pending"){
echo "<span class='pending'>🟡 Pending</span>";
}
elseif($row['status']=="Approved"){
echo "<span class='approved'>🟢 Approved</span>";
}
else{
echo "<span class='rejected'>🔴 Rejected</span>";
}

?>

</td>

</tr>

<?php } ?>

</table>

<a href="../user_dashboard.php" class="btn">
⬅ Back to Dashboard
</a>

</div>

</div>

<div class="footer">

© 2026 MyVoterHelp | Private Assistance Service

<br><br>

<b>Disclaimer:</b>

MyVoterHelp is a private assistance service and is not affiliated with the Election Commission of India.

</div>

</body>
</html>