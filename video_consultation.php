<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['appointment_id'])) {
    echo "Invalid request.";
    exit();
}

$appointment_id = $_GET['appointment_id'];
$roomName = md5($appointment_id . $_SESSION['user_id'] . time());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Consultation</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }
        #meet {
            width: 80%;
            height: 80%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div id="meet"></div>
    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        const domain = "meet.jit.si";
        const options = {
            roomName: "<?php echo $roomName; ?>",
            width: "100%",
            height: "100%",
            parentNode: document.querySelector('#meet')
        };
        const api = new JitsiMeetExternalAPI(domain, options);
    </script>
</body>
</html>
