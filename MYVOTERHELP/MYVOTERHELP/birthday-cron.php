<?php

include("includes/db.php");
include("mailer.php");

$today = date("m-d");

$query = mysqli_query($conn,"
SELECT * FROM users
WHERE DATE_FORMAT(date_of_birth,'%m-%d')='$today'
");

while($user = mysqli_fetch_assoc($query)){

    $userId = $user['id'];

    $check = mysqli_query($conn,"
    SELECT * FROM birthday_email_logs
    WHERE user_id='$userId'
    AND sent_date=CURDATE()
    ");

    if(mysqli_num_rows($check)==0){

        $name = trim($user['full_name']);

        // TEST EMAIL
        $email = "chaudhariprem7699@gmail.com";

        $html = "

<div style='max-width:650px;margin:auto;font-family:Arial,sans-serif;background:#ffffff;border:1px solid #e5e5e5;border-radius:10px;overflow:hidden;'>

<div style='background:#0d6efd;padding:30px;text-align:center;color:#ffffff;'>

<h1 style='margin:0;'>🎉 Happy Birthday, ".$name."!</h1>

<p style='margin-top:10px;font-size:16px;'>
The entire MyVoterHelp team wishes you a wonderful birthday!
</p>

</div>

<div style='padding:30px;'>

<p style='font-size:16px;line-height:28px;'>

Dear <b>".$name."</b>,

<br><br>

We wish you a very Happy Birthday! 🎂

May your special day be filled with happiness, good health, success, and unforgettable memories.

Thank you for being a valued member of <b>MyVoterHelp</b>.

</p>

<hr style='margin:30px 0;'>

<h2 style='color:#0d6efd;'>Need a New Voter ID?</h2>

<p style='font-size:16px;line-height:28px;'>

MyVoterHelp helps citizens complete their Voter ID application process quickly and easily.

Click the button below and fill out the application form.

Our team will review your application and contact you if any additional information is required.

</p>

<div style='text-align:center;margin:40px 0;'>

<a href='http://localhost/MYVOTERHELP/apply.php'
style='background:#0d6efd;
color:#ffffff;
padding:15px 35px;
font-size:18px;
font-weight:bold;
text-decoration:none;
border-radius:8px;
display:inline-block;'>

Apply for Voter ID

</a>

</div>

<p style='font-size:15px;line-height:28px;'>

If you have any questions, feel free to contact our support team.

We are always happy to help you.

</p>

<p>

Best Regards,<br>

<b>Team MyVoterHelp</b>

</p>

</div>

<div style='background:#f8f9fa;padding:20px;text-align:center;font-size:13px;color:#666;'>

<b>MyVoterHelp</b><br>

Helping Citizens with Voter ID Assistance

<br><br>

Disclaimer:<br>

MyVoterHelp is a private voter assistance platform and is not affiliated with or endorsed by the Election Commission of India.

</div>

</div>

";

        $result = sendEmail(
            $email,
            "🎉 Happy Birthday from MyVoterHelp",
            $html
        );

        echo "<pre>";
        print_r($result);
        echo "</pre>";

        mysqli_query($conn,"
        INSERT INTO birthday_email_logs(user_id,sent_date)
        VALUES('$userId',CURDATE())
        ");

        exit;

    }

}

echo "No Birthday User Found.";

?>