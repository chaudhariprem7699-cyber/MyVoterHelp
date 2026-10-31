<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include("../includes/db.php");

$result=mysqli_query($conn,"SELECT * FROM contact_messages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Manage Contact Messages</title>

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
width:96%;
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
min-width:1100px;
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

.delete-btn{
display:inline-block;
background:#dc3545;
color:white;
padding:8px 16px;
border-radius:6px;
text-decoration:none;
font-weight:bold;
}

.delete-btn:hover{
background:#bb2d3b;
}

.back-btn{
display:inline-block;
margin-top:20px;
background:#0d6efd;
color:white;
padding:12px 22px;
border-radius:6px;
text-decoration:none;
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

<h1>📩 MyVoterHelp Admin Panel</h1>

<p>Manage Contact Messages</p>

</div>

<div class="container">

<div class="card">

<h2 style="margin-bottom:20px;">
📩 Contact Messages
</h2>

<table>

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Mobile</th>

<th>Message</th>

<th>Date</th>

<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['mobile']; ?></td>

<td style="white-space:normal;max-width:300px;">
<?php echo $row['message']; ?>
</td>

<td>
<?php echo date("d M Y",strtotime($row['created_at'])); ?>
</td>

<td>

<a class="delete-btn"
href="delete_message.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this message?');">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['mobile']; ?></td>

<td style="max-width:300px;white-space:normal;text-align:left;">
<?php echo $row['message']; ?>
</td>

<td><?php echo date("d M Y",strtotime($row['created_at'])); ?></td>

<td>

<a href="delete_message.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this message?');"
style="display:inline-block;
background:#dc3545;
color:white;
padding:8px 16px;
text-decoration:none;
border-radius:6px;
font-weight:bold;">

🗑 Delete

</a>

</td>

</tr>

<?php } ?>

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