<?php
session_start();

include 'includes/db.php';
include 'mailer.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$message = "";

if (isset($_POST['apply'])) {

    $user_id = $_SESSION['user_id'];

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $aadhaar = $_POST['aadhaar'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];

    $photo = "";
    $aadhaarFile = "";

    if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0){
        $photo = time() . "_" . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/photos/" . $photo);
    }

    if(isset($_FILES['aadhaar_file']) && $_FILES['aadhaar_file']['error'] == 0){
        $aadhaarFile = time() . "_" . basename($_FILES['aadhaar_file']['name']);
        move_uploaded_file($_FILES['aadhaar_file']['tmp_name'], "uploads/aadhaar/" . $aadhaarFile);
    }

    $sql = "INSERT INTO voter_applications
    (user_id, full_name, email, mobile, aadhaar_no, address, city, state, pincode, photo, aadhaar_file)
    VALUES
    ('$user_id','$full_name','$email','$mobile','$aadhaar','$address','$city','$state','$pincode','$photo','$aadhaarFile')";

    if(mysqli_query($conn,$sql)){

        $html = "

<div style='max-width:650px;margin:auto;font-family:Arial,sans-serif;background:#ffffff;border:1px solid #ddd;border-radius:10px;overflow:hidden;'>

<div style='background:#0d6efd;color:white;padding:25px;text-align:center;'>

<h1>Application Received ✅</h1>

</div>

<div style='padding:30px;'>

<h2>Hello ".$full_name.",</h2>

<p style='font-size:16px;line-height:28px;'>

Thank you for submitting your New Voter ID application through <b>MyVoterHelp</b>.

Your application has been received successfully.

</p>

<p style='font-size:16px;line-height:28px;'>

Our verification team will review your application within <b>24 hours</b>.

If any additional information is required, we will contact you.

</p>

<div style='text-align:center;margin:40px 0;'>

<a href='http://localhost/MYVOTERHELP/status.php'
style='background:#0d6efd;
color:white;
padding:15px 30px;
text-decoration:none;
border-radius:6px;
font-weight:bold;'>

Track Application

</a>

</div>

<p>

Thank you for choosing <b>MyVoterHelp</b>.

</p>

<p>

Regards,<br>

<b>Team MyVoterHelp</b>

</p>

</div>

<div style='background:#f5f5f5;padding:20px;text-align:center;font-size:12px;color:#666;'>

Disclaimer:<br>

MyVoterHelp is a private assistance service and is not affiliated with or endorsed by the Election Commission of India.

</div>

</div>

";

        sendEmail(
            $email,
            "✅ Application Received - MyVoterHelp",
            $html
        );

        header("Location: user_dashboard.php?success=1");
        exit;

    } else {

        $message = "Error : " . mysqli_error($conn);

    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Apply New Voter ID</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="register-box">

<h2>Apply for New Voter ID</h2>

<p style="color:red;"><?php echo $message; ?></p>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="full_name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="mobile" placeholder="Mobile Number" required>

<input type="text" name="aadhaar" placeholder="Aadhaar Number" required>

<textarea name="address" placeholder="Full Address" required></textarea>

<input type="text" name="city" placeholder="City" required>

<input type="text" name="state" placeholder="State" required>

<input type="text" name="pincode" placeholder="PIN Code" required>

<br><br>

<label>Passport Photo</label><br>
<input type="file" name="photo" accept="image/*" required>

<br><br>

<label>Aadhaar Card</label><br>
<input type="file" name="aadhaar_file" accept=".jpg,.jpeg,.png,.pdf" required>

<br><br>

<button type="submit" name="apply">Submit Application</button>

</form>

</div>

</body>
</html>