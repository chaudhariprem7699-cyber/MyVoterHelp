 <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'includes/db.php';

$message = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($query) > 0) {

        $user = mysqli_fetch_assoc($query);

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];

            header("Location: user_dashboard.php");
            exit;

        } else {
            $message = "Incorrect password!";
        }

    } else {
        $message = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - MyVoterHelp</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="register-box">

    <h2>User Login</h2>

    <?php if($message!=""){ ?>
        <p style="color:red;"><?php echo $message; ?></p>
    <?php } ?>

    <form method="POST">

        <input type="email" name="email" placeholder="Email Address" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

    </form>

    <p>
        Don't have an account?
        <a href="register.php">Register</a>
    </p>

</div>

</body>
</html>