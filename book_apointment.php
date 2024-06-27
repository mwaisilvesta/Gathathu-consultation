<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'patient') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO appointments (user_id, doctor_id, appointment_date) VALUES ('$user_id', '$doctor_id', '$appointment_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment booked successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
</head>
<body>
    <h2>Book Appointment</h2>
    <form action="book_appointment.php" method="post">
        <label for="doctor_id">Doctor ID:</label><br>
        <input type="text" id="doctor_id" name="doctor_id" required><br>
        <label for="appointment_date">Appointment Date:</label><br>
        <input type="datetime-local" id="appointment_date" name="appointment_date" required><br><br>
        <input type="submit" value="Book Appointment">
    </form>
</body>
</html>
