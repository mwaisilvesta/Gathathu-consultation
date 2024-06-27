<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
$user_id = $_SESSION['user_id'];

$sql = $role == 'doctor' ? "SELECT * FROM appointments WHERE doctor_id=$user_id" : "SELECT * FROM appointments WHERE user_id=$user_id";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <h3>Your Appointments</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Doctor ID</th>
            <th>User ID</th>
            <th>Appointment Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["id"]. "</td>
                    <td>" . $row["doctor_id"]. "</td>
                    <td>" . $row["user_id"]. "</td>
                    <td>" . $row["appointment_date"]. "</td>
                    <td>" . $row["status"]. "</td>
                    <td><a href='video_consultation.php?appointment_id=" . $row["id"] . "'>Start Video Consultation</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No appointments found</td></tr>";
        }
        ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>
