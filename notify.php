<?php
include 'db.php';

function sendEmail($to, $subject, $message) {
    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "Reply-To: no-reply@yourdomain.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);
}

function notifyUsers($appointment_id, $doctor_id, $user_id) {
    global $conn;

    $doctor_sql = "SELECT email FROM users WHERE id=$doctor_id";
    $user_sql = "SELECT email FROM users WHERE id=$user_id";

    $doctor_result = $conn->query($doctor_sql);
    $user_result = $conn->query($user_sql);

    if ($doctor_result->num_rows > 0 && $user_result->num_rows > 0) {
        $doctor_email = $doctor_result->fetch_assoc()['email'];
        $user_email = $user_result->fetch_assoc()['email'];

        $subject = "Video Consultation Scheduled";
        $message = "A video consultation has been scheduled. Please join using the provided link.";

        sendEmail($doctor_email, $subject, $message);
        sendEmail($user_email, $subject, $message);
    }
}
