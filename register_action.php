<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "casino_db";  // ชื่อฐานข้อมูล

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// รับค่าจากฟอร์ม
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$bank_name = $_POST['bank_name'];
$account_number = $_POST['account_number'];
$full_name = $_POST['full_name'];

// ตรวจสอบการยืนยันรหัสผ่าน
if ($password !== $confirm_password) {
    // แจ้งเตือนหากรหัสผ่านไม่ตรงกัน และกลับไปที่หน้าสมัครสมาชิก
    echo "<script>alert('รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน'); window.location.href='register.php';</script>";
    exit;
}

// เข้ารหัสรหัสผ่าน (การใช้งานการเข้ารหัสเพื่อความปลอดภัย)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// เพิ่มข้อมูลลงในตาราง users
$sql = "INSERT INTO users (phone_number, password, confirm_password, bank_name, account_number, full_name)
        VALUES ('$phone', '$hashed_password', '$hashed_password', '$bank_name', '$account_number', '$full_name')";

if ($conn->query($sql) === TRUE) {
    // แจ้งเตือนหากสมัครสมาชิกสำเร็จและเปลี่ยนไปที่หน้า index.php (หน้าล็อคอิน)
    echo "<script>alert('สมัครสมาชิกสำเร็จ!'); window.location.href='index.php';</script>";
} else {
    // แจ้งเตือนหากเกิดข้อผิดพลาด
    echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "'); window.location.href='register.php';</script>";
}

$conn->close();
?>


