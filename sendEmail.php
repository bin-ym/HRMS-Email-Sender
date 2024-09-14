<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoload file
require 'vendor/autoload.php';

header('Content-Type: application/json');

$response = array('status' => 'error', 'message' => 'Failed to send email.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'binyam.tagel@gmail.com'; // Your Gmail address
        $mail->Password = 'tvgo bnmt zrib micm'; // Your Gmail App password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('binyam.tagel@gmail.com', 'HRMS');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Message from HRMS - $name";
        $mail->Body = "You have received a message from $name:<br><br>$message";

        $mail->send();

        $response['status'] = 'success';
        $response['message'] = 'Email sent successfully';
    } catch (Exception $e) {
        $response['message'] = 'Failed to send email. Error: ' . $mail->ErrorInfo;
    }
}

echo json_encode($response);
?>
