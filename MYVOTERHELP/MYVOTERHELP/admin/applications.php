<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include("../includes/db.php");

$result = mysqli_query($conn,"SELECT * FROM voter_applications ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Manage Applications | MyVoterHelp</title>

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
box-shadow:0 2px 8px rgba(0,0,0,.2);
}

.header h1{
font-size:32px;
}

.header p{
margin-top:8px;
font-size:18px;
}

.container{
width:96%;
margin:30px auto;
}

.card{
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 4px 10px rgba(0,0,0,.15);
overflow:auto;
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
min-width:1400px;
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
background:#f9f9f9;
}

..photo-btn,
.aadhaar-btn,
.approve-btn,
.reject-btn{
display:inline-block;
padding:8px 16px;
text-decoration:none;
color:white;
border-radius:6px;
font-size:13px;
font-weight:bold;
white-space:nowrap;
margin:2px;
}

.photo-btn{
background:#0d6efd;
}

.aadhaar-btn{
background:#6f42c1;
}

.approve-btn{
background:#198754;
}

.reject-btn{
background:#dc3545;
}

.approve-btn{
background:#198754;
color:white;
padding:8px 14px;
text-decoration:none;
border-radius:5px;
font-size:14px;
margin-right:5px;
}

.reject-btn{
background:#dc3545;
color:white;
padding:8px 14px;
text-decoration:none;
border-radius:5px;
font-size:14px;
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

.back-btn{
display:inline-block;
margin-top:25px;
background:#0d6efd;
color:white;
padding:12px 22px;
text-decoration:none;
border-radius:6px;
font-weight:bold;
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

<h1>🗳 MyVoterHelp Admin Panel</h1>

<p>Manage All Voter Applications</p>

</div>

<div class="container">

<div class="card">

<h2>📋 All Applications</h2>

<table>

<tr>

<th>ID</th>

<th>Full Name</th>

<th>Email</th>

<th>Mobile</th>

<th>Aadhaar</th>

<th>Photo</th>

<th>Aadhaar Card</th>

<th>Address</th>

<th>City</th>

<th>State</th>

<th>PIN</th>

<th>Status</th>

<th>Action</th>

<th>Date</th>

</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['mobile']; ?></td>

<td><?php echo $row['aadhaar_no']; ?></td>

<td>

<a class="photo-btn"
href="../uploads/photos/<?php echo $row['photo']; ?>"
target="_blank">

View Photo

</a>

</td>
<td>

<a class="aadhaar-btn"
href="../uploads/aadhaar/<?php echo $row['aadhaar_file']; ?>"
target="_blank">

View Aadhaar

</a>

</td>

<td><?php echo $row['address']; ?></td>

<td><?php echo $row['city']; ?></td>

<td><?php echo $row['state']; ?></td>

<td><?php echo $row['pincode']; ?></td>

<td>

<?php

if($row['status']=="Pending"){

echo "<span class='pending'>🟡 Pending</span>";

}elseif($row['status']=="Approved"){

echo "<span class='approved'>🟢 Approved</span>";

}else{

echo "<span class='rejected'>🔴 Rejected</span>";

}

?>

</td>

<td>

<a class="approve-btn"
href="approve.php?id=<?php echo $row['id']; ?>">

Approve

</a>

<a class="reject-btn"
href="reject.php?id=<?php echo $row['id']; ?>">

Reject

</a>

</td>

<td>

<?php echo date("d M Y",strtotime($row['created_at'])); ?>

</td>

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

© 2026 <b>MyVoterHelp</b> | Private Assistance Service

</p>

<br>

<p>

<strong>Disclaimer:</strong>

MyVoterHelp is a private assistance service and is not affiliated with the Election Commission of India.

</p>

</div>

</body>

</html>