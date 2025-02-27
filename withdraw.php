<?php
// เริ่มต้น session
session_start();

// ตรวจสอบว่าผู้ใช้ล็อคอินหรือไม่
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// สร้าง session ใหม่เพื่อเพิ่มความปลอดภัย
session_regenerate_id(true);

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wallet_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$balance = $_SESSION['balance'];

// ฟังก์ชันถอนเงิน
if (isset($_POST['withdraw'])) {
    $withdraw_amount = $_POST['withdraw_amount'];
    if ($withdraw_amount > 0 && $withdraw_amount <= $balance) {
        $sql = "UPDATE user_wallet SET balance = balance - ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $withdraw_amount, $user_id);
        $stmt->execute();
        $stmt->close();

        // อัปเดตยอดเงินใน session
        $_SESSION['balance'] -= $withdraw_amount;

        header("Location: wallet.php"); // รีเฟรชหน้าเพื่อแสดงยอดเงินล่าสุด
        exit;
    } else {
        echo "<script>alert('ยอดเงินไม่เพียงพอ');</script>";
    }
}

// ปิดการเชื่อมต่อ
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ถอนเงิน - คาสิโนออนไลน์</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            color: #333;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #FF5722;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            width: 100%;
        }
        button:hover {
            background-color: #FF3D00;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>ถอนเงิน</h2>
        <form method="POST">
            <label for="withdraw_amount">จำนวนเงินที่ต้องการถอน:</label>
            <input type="number" name="withdraw_amount" min="1" required>
            <button type="submit" name="withdraw">ยืนยันการถอน</button>
        </form>
    </div>

</body>
</html>
