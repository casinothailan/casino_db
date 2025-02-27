<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname1 = "casino_db"; // ฐานข้อมูลผู้ใช้
$dbname2 = "wallet_system"; // ฐานข้อมูลระบบกระเป๋าเงิน

// สร้างการเชื่อมต่อกับฐานข้อมูล
$conn = new mysqli($servername, $username, $password);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// เลือกฐานข้อมูล user casino_db
$conn->select_db($dbname1);

// ตรวจสอบว่า session user_id มีอยู่หรือไม่
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('กรุณาล็อกอินก่อนทำการฝากเงิน');</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$full_name = $_SESSION['full_name'] ?? 'ไม่พบชื่อผู้ใช้';
$balance = $_SESSION['balance'] ?? 0.00;

// ตรวจสอบว่า user_id มีอยู่ในฐานข้อมูลผู้ใช้
$sql_check_user = "SELECT id FROM users WHERE id = ?";
$stmt_check_user = $conn->prepare($sql_check_user);
$stmt_check_user->bind_param("i", $user_id);
$stmt_check_user->execute();
$stmt_check_user->store_result();

if ($stmt_check_user->num_rows == 0) {
    echo "<script>alert('ไม่พบผู้ใช้นี้ในระบบ กรุณาล็อกอินใหม่');</script>";
    exit;
}

// สลับไปใช้ฐานข้อมูล wallet_system
$conn->select_db($dbname2);

// ถ้าผู้ใช้มีในระบบแล้วให้ทำการฝากเงิน
if (isset($_POST['deposit'])) {
    $deposit_amount = $_POST['deposit_amount'];
    if ($deposit_amount > 0) {
        // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลคำขอฝากเงิน
        $sql = "INSERT INTO deposit_requests (user_id, amount, status) VALUES (?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $user_id, $deposit_amount);
        if ($stmt->execute()) {
            echo "<script>alert('คำขอฝากเงินถูกส่งแล้ว กรุณารอการอนุมัติจากแอดมิน');</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการทำรายการ');</script>";
        }
    } else {
        echo "<script>alert('จำนวนเงินต้องมากกว่า 0');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฝากเงิน</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet);
            color: white;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #fff;
            text-align: center;
            font-size: 18px;
        }
        .btn {
            background: gold;
            color: black;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
        }
        .btn:hover {
            background: darkorange;
        }
        .bank-info {
            margin-top: 20px;
            font-size: 18px;
        }
        .contact-line img {
            width: 30px;
            vertical-align: middle;
        }
        .contact-line a {
            display: flex;
            align-items: center;
            justify-content: center;
            background: gold;
            color: black;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            margin-top: 10px;
        }
    </style>
    <script>
        function updateDepositAmount() {
            var amount = document.getElementById('amount').value;
            document.getElementById('deposit-amount').textContent = amount;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>ฝากเงิน</h2>
        <form method="POST">
            <input type="number" id="amount" name="deposit_amount" placeholder="จำนวนเงินขั้นต่ำ 1 บาท" min="1" oninput="updateDepositAmount()">
            <button type="submit" class="btn" name="deposit">💰 ฝากเงิน</button>
        </form>
        
        <div class="bank-info">
            <p><strong>ยอดโอนทั้งหมด:</strong> <span id="deposit-amount">0</span> บาท</p>
            <p><strong>เลขที่บัญชี:</strong> 2033531462</p>
            <p><strong>ธนาคาร:</strong> กสิกรไทย</p>
            <p><strong>ชื่อบัญชี:</strong> นาย สุริยะ โฮชิน</p>
            <button class="btn" onclick="copyToClipboard()">📋 คัดลอกเลขบัญชี</button>
        </div>
        
        <div class="contact-line">
            <a href="https://line.me/ti/p/~bmwx4567" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Line_logo_2020.png" alt="LINE">
                ติดต่อเรา
            </a>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            var text = "2033531462"; // เลขบัญชี
            navigator.clipboard.writeText(text).then(function() {
                alert('คัดลอกเลขบัญชีสำเร็จ');
            });
        }
    </script>
</body>
</html>


