<?php

include("mailer.php");

echo sendEmail(

"chaudhariprem7699@gmail.com",

"MyVoterHelp Test Email",

"<h2>Hello!</h2>
<p>This email was sent successfully from MyVoterHelp.</p>"

);

?>