<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name  = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $msg   = htmlspecialchars($_POST['message']);

    $to = "support@cloudbusket.com";   // change if needed
    $subject = "New Contact Request - CloudBusket";

    $body = "New contact submission:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n\n";
    $body .= "Message:\n$msg\n";

    $headers = "From: no-reply@cloudbusket.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "<h2>Thank you! We will contact you soon.</h2>";
    } else {
        echo "<h2>Error sending message. Please try again later.</h2>";
    }
}
?>

