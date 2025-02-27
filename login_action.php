<?php
// กำหนดค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "casino_db";  // ชื่อฐานข้อมูล

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$phone = $_POST['phone'];
$password = $_POST['password'];

// ค้นหาผู้ใช้ในฐานข้อมูล
$sql = "SELECT * FROM users WHERE phone_number='$phone'";
$result = $conn->query($sql);

// ตรวจสอบว่าพบผู้ใช้หรือไม่
if ($result->num_rows > 0) {
    // ถ้าพบผู้ใช้
    $row = $result->fetch_assoc();
    
    // ตรวจสอบรหัสผ่าน
    if (password_verify($password, $row['password'])) {
        // ถ้ารหัสผ่านถูกต้อง ให้เก็บ session และไปหน้ากระเป๋าตังค์
        session_start();
        $_SESSION['user_id'] = $row['id'];  // เก็บ user_id ไว้ใน session
        $_SESSION['full_name'] = $row['full_name']; // เก็บชื่อผู้ใช้ใน session

        // แจ้งเตือนและไปหน้ากระเป๋าตังค์
        echo "<script>alert('ล็อคอินสำเร็จ!'); window.location.href='wallet.php';</script>";
    } else {
        // ถ้ารหัสผ่านไม่ถูกต้อง แจ้งเตือน
        echo "<script>alert('รหัสผ่านไม่ถูกต้อง!'); window.location.href='index.php';</script>";
    }
} else {
    // ถ้าไม่พบผู้ใช้
    echo "<script>alert('ไม่พบผู้ใช้นี้!'); window.location.href='index.php';</script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้ากระเป๋าตัง - คาสิโนออนไลน์</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #FF7F50, #FFD700, #00FA9A);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .wallet-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 8px;
            width: 70%;
            text-align: center;
        }
        h2 {
            font-size: 24px;
            color: #FFD700;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #FFD700;
        }
        th {
            background-color: #D32F2F;
            color: white;
        }
        td {
            background-color: #333;
            color: white;
        }
        .btn-reload {
            background-color: #FF5722;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-reload:hover {
            background-color: #FF3D00;
        }
        .btn-logout {
            margin-top: 20px;
            padding: 10px;
            background-color: #B71C1C;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-logout:hover {
            background-color: #D32F2F;
        }
    </style>
</head>
<body>

    <div class="wallet-container">
        <h2>ยินดีต้อนรับ, <?php echo $full_name; ?>!</h2>

        <!-- ตารางแสดงข้อมูลยอดเงินคงเหลือ -->
        <table>
            <tr>
                <th>ฟังก์ชัน</th>
                <th>รายละเอียด</th>
            </tr>
            <tr>
                <td>ยอดเงินคงเหลือ</td>
                <td><?php echo number_format($balance, 2); ?> บาท</td>
            </tr>
            <tr>
                <td>ฝากเงิน</td>
                <td><a href="wallet_system.php" class="btn-reload">ฝากเงิน</a></td>
            </tr>
            <tr>
                <td>ถอนเงิน</td>
                <td><a href="withdraw_system.php" class="btn-reload">ถอนเงิน</a></td>
            </tr>
            <tr>
                <td>เข้าเล่น</td>
                <td><a href="#">เข้าเล่น</a></td>
            </tr>
        </table>

        <button class="btn-logout" onclick="window.location.href='logout.php';">ออกจากระบบ</button>
    </div>

</body>
</html>