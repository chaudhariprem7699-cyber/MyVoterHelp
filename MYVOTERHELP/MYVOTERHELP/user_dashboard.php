<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>User Dashboard | MyVoterHelp</title>

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

.header p{
margin-top:8px;
font-size:18px;
}

.container{
width:90%;
max-width:1100px;
margin:30px auto;
}

.success{
background:#d1e7dd;
color:#0f5132;
padding:15px;
border-radius:8px;
margin-bottom:20px;
text-align:center;
font-size:18px;
font-weight:bold;
}

.card-container{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
}

.card{
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 4px 10px rgba(0,0,0,.15);
text-align:center;
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
}

.card h2{
color:#0d6efd;
margin-bottom:10px;
}

.card p{
color:#555;
margin-bottom:20px;
}

.btn{
display:inline-block;
padding:10px 18px;
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
font-size:14px;
}

</style>

</head>

<body>

<div class="header">

<h1>🗳 MyVoterHelp</h1>

<p>
Welcome,
<b><?php echo $_SESSION['user_name']; ?></b>
</p>

</div>

<div class="container">

<?php
if(isset($_GET['success'])){
?>
<div class="success">
✅ Application Submitted Successfully! Our team will review your application within 24 hours.
</div>
<?php
}
?>

<div class="card-container">

<div class="card">

<h2>📝 Apply for New Voter ID</h2>

<p>
Submit your New Voter ID application quickly and securely.
</p>

<a href="apply.php" class="btn">
Apply Now
</a>

</div>

<div class="card">

<h2>📋 My Application Status</h2>

<p>
Track your submitted application and view its current status.
</p>

<a href="admin/status.php" class="btn">
View Status
</a>

</div>

<div class="card">

<h2>👤 My Profile</h2>

<p>
Welcome to your MyVoterHelp account dashboard.
</p>

<a href="#" class="btn">
Profile
</a>

</div>

<div class="card">

<h2>🚪 Logout</h2>

<p>
Securely logout from your account.
</p>

<a href="logout.php" class="btn">
Logout
</a>

</div>

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