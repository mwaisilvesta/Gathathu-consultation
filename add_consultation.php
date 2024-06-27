<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'doctor') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $notes = $_POST['notes'];
    $prescription = $_POST['prescription'];

    $sql = "INSERT INTO consultations (appointment_id, notes, prescription) VALUES ('$appointment_id', '$notes', '$prescription')";

    if ($conn->query($sql) === TRUE) {
        echo "Consultation added successfully";
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
    <title>Add Consultation</title>
</head>
<body>
    <h2>Add Consultation</h2>
    <form action="add_consultation.php" method="post">
        <label for="appointment_id">Appointment ID:</label><br>
        <input type="text" id="appointment_id" name="appointment_id" required><br>
        <label for="notes">Notes:</label><br>
        <textarea id="notes" name="notes" required></textarea><br>
        <label for="prescription">Prescription:</label><br>
        <textarea id="prescription" name="prescription"></textarea><br><br>
        <input type="submit" value="Add Consultation">
    </form>
</body>
</html>
