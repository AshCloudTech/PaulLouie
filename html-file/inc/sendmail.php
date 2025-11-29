<?php

require_once('./phpmailer/class.phpmailer.php');
require_once('./phpmailer/class.smtp.php');

$mail = new PHPMailer();
$mail->isSMTP();

// ---------------------- SMTP CONFIG ----------------------

$mail->Host = '';            // e.g., 'smtp.gmail.com'
$mail->SMTPAuth = true;
$mail->Username = '';        // SMTP username
$mail->Password = '';        // SMTP password
$mail->SMTPSecure = 'tls';   // or 'ssl'
$mail->Port = 587;           // SMTP port
$mail->isHTML(true);         // Important: send HTML emails

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

    $mail->SetFrom("", "Website Contact Form");
    $mail->AddAddress("", "Website Enquiry");

    $mail->AddReplyTo($email, $name);

    $mail->Subject = "New Enquiry Received";

    $body = "
        <h2>New Enquiry</h2>
        Name: $name <br>
        Phone: $phone <br>
        Email: $email <br>
        Windows: $windows <br>
        House Type: $house_type <br>
        Storeys: $storeys <br>
        Conservatory: $conservatory <br>
        One-off Clean: $one_off_clean <br>
        Maintenance Type: $maintenance_type <br>
        Message: $message <br>
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
