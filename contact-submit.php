<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitize input
    $name  = strip_tags($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = strip_tags($_POST['phone']);
    $msg   = str_replace(["\n", "\r"], " ", strip_tags($_POST['message']));
    $date  = date("Y-m-d H:i:s");
    $ip    = $_SERVER['REMOTE_ADDR'];

    // ---- SAVE TO CSV FILE ----
    $file = __DIR__ . "/data/contacts.csv";
    $handle = fopen($file, "a");

    if ($handle) {
        fputcsv($handle, [$date, $name, $email, $phone, $msg, $ip]);
        fclose($handle);
    }

    // ---- SEND EMAIL ----
    $to = "tapasjana@gmail.com";
    $subject = "New Contact Request - CloudBusket";

    $body = "New contact submission:\n\n";
    $body .= "Date: $date\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "IP: $ip\n\n";
    $body .= "Message:\n$msg\n";

    $headers = "From: no-reply@cloudbusket.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    mail($to, $subject, $body, $headers);

    echo "<h2>Thank you! We will contact you soon.</h2>";
}
?>

