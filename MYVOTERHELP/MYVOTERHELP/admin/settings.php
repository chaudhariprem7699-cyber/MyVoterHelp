<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Website Settings</title>

<link rel="stylesheet" href="../assets/css/style.css">

<style>

.container{
width:600px;
margin:40px auto;
padding:20px;
background:#fff;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,.1);
}

input{
width:100%;
padding:10px;
margin:10px 0;
}

button{
padding:10px 20px;
background:#0d6efd;
color:#fff;
border:none;
border-radius:5px;
cursor:pointer;
}

</style>

</head>

<body>

<div class="container">

<h2>⚙ Website Settings</h2>

<form>

<label>Website Name</label>
<input type="text" value="MyVoterHelp" readonly>

<label>Admin Email</label>
<input type="email" value="chaudhariprem7699@gmail.com" readonly>

<label>Company Name</label>
<input type="text" value="MyVoterHelp Team" readonly>

<label>Website Version</label>
<input type="text" value="Version 1.0" readonly>

<button type="button">Settings Saved</button>

</form>

<br>

<a href="dashboard.php">⬅ Back to Dashboard</a>

</div>

</body>
</html>