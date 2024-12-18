<?php

include("connect.php");
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$id = $_POST["id"];
//$time = $_POST["timer"];



$sql = "SELECT * FROM tbl_auction WHERE a_id='$id'";
$result = $connect->query($sql);

$result->num_rows;
$row = $result->fetch_assoc();
$time =  $row["time"];
$product_name =  $row["p_name"];
$a_price =  $row["a_price"];
$user_id =  $row["user_id"];
$current_time = date('H:i:s');

$select = "SELECT * FROM tbl_user WHERE user_id='$user_id'";
$result = mysqli_query($connect, $select);
$check = mysqli_fetch_assoc($result);
$email = $check['email'];
$username = $check['username'];

// Convert the time string to a DateTime object

$dateTime = date_create($time);
date_sub($dateTime, date_interval_create_from_date_string('1 hour'));
$newTime = date_format($dateTime, 'H:i:s');


$update = "update tbl_auction set time='$newTime' where a_id='$id'";
// echo $update;
// exit();
if (mysqli_query($connect, $update)) {
    echo 1;

    $body = "<p>Dear $username, <br>
    
    We're thrilled to inform you that you've emerged as the highest bidder and successfully won the auction for $product_name !<br><br>
    
    Your determination and enthusiasm have paid off, and we couldn't be happier to have you as the winning bidder. Your bid of $a_price was the highest, securing you the coveted prize.<br><br>
    
    Here are the details of your winning:<br>
    
    - Item:<b><u>$product_name</u></b><br>
    - Winning Bid Amount:<b><u>$a_price</u></b><br><br> 
   
    
    Now that you've won, here's what you need to do next:<br>
    
    1. Payment: Please proceed with the payment for the winning bid amount within  $a_price . You can find payment instructions and methods in the auction listing or on our website.<br>
       
    2. Shipping Information: Kindly provide us with the shipping address and any specific delivery instructions to ensure smooth and timely delivery of your prize.<br><br>
    
    3. Confirmation: Once payment is received and confirmed, we'll initiate the shipping process and provide you with tracking information so you can keep an eye on your package's journey to your doorstep.<br><br>
    
    We want to express our gratitude for your participation in the auction. Your support contributes to the success of our platform and helps us continue providing exciting opportunities for our community.<br><br>
    
    If you have any questions or need assistance at any step of the process, please don't hesitate to reach out to our customer support team. We're here to help make your auction-winning experience as seamless as possible.<br><br>
    
    Congratulations once again on your win! We hope you enjoy your new $product_name.<br><br>
    
    Best regards,<br>
    
    <b>Bid Bazzar</b></p>";

    require 'Mailer/vendor/autoload.php';
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        $mail->Username   = 'patelkrupal679@gmail.com'; // Your Gmail email address
        $mail->Password   = 'gvoi wbtn whnu joic';        // Your Gmail password
        $mail->Username   = ''; // Your Gmail email address
        $mail->Password   = '';        // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('patelkrupal679@gmail.com', 'Bid Bazzer');
        $mail->setFrom('', 'Bid Bazzer');
        $mail->addAddress($email,  $username);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Congratulations! You have Won the Auction!';
        $mail->Body    = "<p> $body </p>";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    echo 0;
}

?>