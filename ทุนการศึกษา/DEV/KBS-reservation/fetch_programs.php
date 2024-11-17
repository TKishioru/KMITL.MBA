<?php
//session
session_start();
//display error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "dbconnect.php"; //$conn is default

function getPasswordLogin($email)
{
    $sql = "SELECT name,email,password,status FROM users WHERE email = '$email'";
    $result = $GLOBALS['conn']->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['status'] = $row['status'];
            return $row['password'];
        }
    }
}

if (isset($_REQUEST['btn_register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $status = "student";

    // ตรวจสอบว่ารหัสผ่านและยืนยันรหัสผ่านตรงกัน
    if ($password !== $confirm_password) {
        echo "รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน กรุณาลองใหม่";
    } else {
        // เข้ารหัสรหัสผ่านs
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(name,email,password,status) VALUES('$name','$email','$password','$status')";
        mysqli_query($GLOBALS['conn'], $sql);

        header("location: login.php");
    }
}
if (isset($_REQUEST['btn_login'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; //md5($password)

    //if (empty($email)) {
    //    echo "Email is required";
    //}
    if ($password == getPasswordLogin($email)) {
        header("location: index.php");
    }
}

if (isset($_POST['room_id'])) {
    $room_id = $_POST['room_id'];

    // ดึงข้อมูลจำนวนความจุของห้องตาม room_id
    $sql = "SELECT capacity FROM rooms WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $stmt->bind_result($capacity);
    $stmt->fetch();
    $stmt->close();

    echo $capacity;  // ส่งจำนวนความจุกลับไปที่ AJAX
}

if (isset($_POST['btn_addevent'])) {
    // ดึงค่าจากฟอร์ม
    $event_title = $_POST['event-title'] ?? '';
    $event_date_start = $_POST['event-date-start'] ?? '';
    $event_time_start = $_POST['event-time-start'] ?? '';
    $event_date_end = $_POST['event-date-end'] ?? '';
    $event_time_end = $_POST['event-time-end'] ?? '';
    $event_room = $_POST['event-room'] ?? '';
    $event_guest = $_POST['event-guest'] ?? '';
    $event_name = $_SESSION['name'] ?? ''; // ดึงข้อมูลผู้จองจาก Session
    $event_phone = $_POST['event-phone'] ?? '';
    $event_type = $_SESSION['status'] ?? ''; // ดึงประเภทของคนจาก Session
    $event_amenities = isset($_POST['amenities']) ? implode(', ', $_POST['amenities']) : ''; // รวมค่าจาก checkbox

    // ตรวจสอบข้อมูลที่จำเป็น
    if (empty($event_title) || empty($event_date_start) || empty($event_time_start) || empty($event_room) || empty($event_guest)) {
        die('กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน');
    }

    // ตรวจสอบการจองซ้ำ
    $sql_check = "SELECT * FROM reservations 
              WHERE event_room = ? 
              AND (
                   (event_date_start = ? AND event_time_start < ? AND event_time_end > ?)
                   OR
                   (event_date_end = ? AND event_time_start < ? AND event_time_end > ?)
                   OR
                   (event_date_start <= ? AND event_date_end >= ?)
              )";

    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param(
        "sssssssss",
        $event_room,
        $event_date_start,
        $event_time_end,
        $event_time_start,
        $event_date_end,
        $event_time_end,
        $event_time_start,
        $event_date_start,
        $event_date_end
    );

    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    // ถ้าพบการจองซ้ำ
    if ($result_check->num_rows > 0) {
        echo "Error: Room is already booked for the selected date and time.";
        echo "Conflicting bookings:<br>";

    while ($row = $result_check->fetch_assoc()) {
        echo "- Event: " . $row['event_title'] . "<br>";
        echo "  Start: " . $row['event_date_start'] . " " . $row['event_time_start'] . "<br>";
        echo "  End: " . $row['event_date_end'] . " " . $row['event_time_end'] . "<br><br>";
    }
    } else {
        // ถ้าไม่มีการจองซ้ำ ให้เพิ่มข้อมูลการจองใหม่
         // SQL สำหรับบันทึกข้อมูลการจอง
    $sql = "INSERT INTO reservations (event_title, event_date_start, event_time_start, event_date_end, event_time_end, event_room, event_guest, event_name, event_phone, event_type, event_amenities)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $event_title, $event_date_start, $event_time_start, $event_date_end, $event_time_end, $event_room, $event_guest, $event_name, $event_phone, $event_type, $event_amenities);

    // บันทึกข้อมูลลงฐานข้อมูล
    if ($stmt->execute()) {
        echo "การจองของคุณถูกบันทึกเรียบร้อยแล้ว";
        header("Location: reservation.php"); // เปลี่ยนเส้นทางไปยังหน้าความสำเร็จ
        exit;
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }

        $stmt_insert->close();
    }
    // ปิดการเชื่อมต่อ
    $stmt_check->close();
    $conn->close();
}
if (isset($_POST['btn_addevent'])) {
    
}