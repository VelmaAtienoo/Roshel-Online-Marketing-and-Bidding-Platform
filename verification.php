<?php
session_start();

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Redirect to home if already logged in
if (isset($_SESSION['username'])) {
    header("location:home.php");
    exit();
}

// Function to send OTP
function sendOtp($email, $otp)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use a reliable SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Replace with your email
        $mail->Password = 'your-email-password'; // Replace with your email password or App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Bid Bazaar'); // Sender
        $mail->addAddress($email); // Recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Bid Bazaar';
        $mail->Body    = "Your OTP is: <b>$otp</b>. Please use this to verify your email.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}

// Generate and send OTP if not already set
if (!isset($_SESSION['otp'])) {
    $otp = rand(100000, 999999); // Generate a 6-digit OTP
    $_SESSION['otp'] = $otp;

    // Determine recipient email (for both user and vendor)
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    } elseif (isset($_SESSION['vemail'])) {
        $email = $_SESSION['vemail'];
    } else {
        $email = 'unknown';
    }

    // Attempt to send OTP
    if (!sendOtp($email, $otp)) {
        echo '<script>alert("Failed to send OTP. Please try again later.")</script>';
    }
}

// Verify OTP
if (isset($_POST['btnsubmit'])) {
    $cotp = $_POST['otp'];

    if (isset($_SESSION['otp']) && $_SESSION['otp'] == $cotp) {
        // Redirect to login if OTP matches
        header("location:login.php");
        unset($_SESSION['otp'], $_SESSION['email'], $_SESSION['vemail']);
        exit();
    }

    echo '<script>alert("Your OTP was incorrect. Please try again.")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="singup.css">
    <title>Bid Bazaar</title>
</head>

<body>
    <form action="" method="POST">
        <div class="container">
            <div class="top"></div>
            <div class="bottom"></div>
            <div class="center">
                <h2><b>Bid Bazaar</b></h2>
                <h1>Verify Email Address</h1>
                <h5>
                    To verify your email, we've sent a One Time<br>
                    Password (OTP) to <u>
                        <?php
                        // Display email for both user and vendor
                        if (isset($_SESSION['email'])) {
                            echo $_SESSION['email'];
                        } elseif (isset($_SESSION['vemail'])) {
                            echo $_SESSION['vemail'];
                        }
                        ?>
                    </u>
                </h5>

                <?php
                // Display OTP for both user and vendor with a positive message
                if (isset($_SESSION['otp'])) {
                    echo "<p style='color: green;'>Here is your OTP: <b>{$_SESSION['otp']}</b></p>";
                }
                ?>

                <input type="text" placeholder="Enter OTP" name="otp" required />
                <input type="submit" value="Submit" id="button" name="btnsubmit" />
            </div>
        </div>
    </form>
</body>

</html>
