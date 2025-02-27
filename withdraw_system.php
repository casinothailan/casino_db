<?php
session_start();

// ตรวจสอบว่าผู้ใช้ล็อคอินหรือไม่
if (!isset($_SESSION['user_id'])) {
    // ถ้าไม่ได้ล็อคอิน ให้ redirect ไปหน้า login
    header("Location: index.php");
    exit;
}

// สร้าง session ใหม่เพื่อเพิ่มความปลอดภัย
session_regenerate_id(true);

// ตรวจสอบการส่งข้อมูลจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $withdraw_amount = $_POST['withdraw_amount'] ?? 0;

    // ตรวจสอบว่ามียอดเงินเพียงพอในการถอน
    if ($withdraw_amount > 0 && $withdraw_amount <= $_SESSION['balance']) {
        // สมมติว่ามีการเชื่อมต่อกับฐานข้อมูลแล้ว
        // คำนวณยอดเงินใหม่
        $_SESSION['balance'] -= $withdraw_amount;

        // เปลี่ยนเส้นทางกลับไปยังหน้า wallet
        header("Location: wallet.php");
        exit;
    } else {
        $error_message = "ยอดเงินไม่เพียงพอ หรือจำนวนเงินที่กรอกไม่ถูกต้อง!";
    }
}

// แสดงข้อมูลผู้ใช้จาก session พร้อมป้องกัน XSS
$full_name = htmlspecialchars($_SESSION['full_name'], ENT_QUOTES, 'UTF-8');
$balance = $_SESSION['balance'] ?? 0;  // ยอดเงินคงเหลือ
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
        form {
            margin-top: 20px;
        }
        input[type="number"] {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            width: 100%;
            border-radius: 5px;
        }
        button {
            background-color: #FF5722;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #FF3D00;
        }
        .error {
            color: #FF0000;
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="wallet-container">
        <h2>ถอนเงิน</h2>

        <!-- แสดงข้อความข้อผิดพลาดหากมี -->
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="withdraw_system.php">
            <label for="withdraw_amount">จำนวนเงินที่ต้องการถอน:</label>
            <input type="number" id="withdraw_amount" name="withdraw_amount" required>
            <button type="submit">ถอนเงิน</button>
        </form>
        <br>
        <p>ยอดเงินคงเหลือ: <?php echo number_format($balance, 2); ?> บาท</p>
    </div>

</body>
</html>
