<?php
include "header.php";
$event_id = $_GET['id'];

$sql = "SELECT event_title, event_name, event_phone, event_room, event_guest, event_date_start, event_time_start, event_date_end, event_time_end FROM events WHERE id = $event_id";
$result = $conn->query($sql);

$event = null;

if ($result->num_rows > 0) {
    $event = $result->fetch_assoc();
}

echo json_encode($event);

$conn->close();
?>
