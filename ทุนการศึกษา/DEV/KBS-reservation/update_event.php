<?php
include "header.php";

// รับข้อมูลจาก AJAX
$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$color = $_POST['color'];

// อัปเดตข้อมูลอีเว้นท์
$sql = "UPDATE events SET event_title = ?, event_date_start = ?, event_date_end = ?, event_color = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $title, $start, $end, $color, $id);

if ($stmt->execute()) {
    echo "Event updated successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
