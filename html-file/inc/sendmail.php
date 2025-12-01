<?php

require_once('./phpmailer/class.phpmailer.php');
require_once('./phpmailer/class.smtp.php');

$mail = new PHPMailer();
$mail->isSMTP();

// ---------------------- SMTP CONFIG ----------------------
$mail->Host       = 'smtp.hostinger.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'contact@cloudtechnologiesltd.com';
$mail->Password   = '@Cloudtech123';
$mail->SMTPSecure = 'ssl';
$mail->Port       = 465;
$mail->isHTML(true);

// ---------------------- PROCESS FORM ----------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name             = $_POST['form_name'] ?? '';
    $phone            = $_POST['form_phone'] ?? '';
    $email            = $_POST['form_email'] ?? '';
    $windows          = $_POST['windows'] ?? '';
    $house_type       = $_POST['house_type'] ?? '';
    $storeys          = $_POST['storeys'] ?? '';
    $conservatory     = $_POST['conservatory'] ?? '';
    $one_off_clean    = $_POST['one_off_clean'] ?? '';
    $maintenance_type = $_POST['maintenance_type'] ?? '';
    $message          = $_POST['form_message'] ?? '';


    $mail->SetFrom("contact@cloudtechnologiesltd.com", "Website Contact Form");


    $mail->AddAddress("contact@cloudtechnologiesltd.com", "Website Enquiry");

    // Reply-to user
    $mail->AddReplyTo($email, $name);

    $mail->Subject = "New Enquiry Received";

    $body = "
        <h2>New Enquiry</h2>
        <strong>Name:</strong> $name <br>
        <strong>Phone:</strong> $phone <br>
        <strong>Email:</strong> $email <br>
        <strong>Windows:</strong> $windows <br>
        <strong>House Type:</strong> $house_type <br>
        <strong>Storeys:</strong> $storeys <br>
        <strong>Conservatory:</strong> $conservatory <br>
        <strong>One-off Clean:</strong> $one_off_clean <br>
        <strong>Maintenance Type:</strong> $maintenance_type <br>
        <strong>Message:</strong> $message <br>
    ";

    $mail->MsgHTML($body);

    if ($mail->Send()) {
        echo "SUCCESS";
    } else {
        echo "ERROR: " . $mail->ErrorInfo;
    }
} else {
    echo "Invalid request.";
}
