<?php
// เริ่มต้น session
session_start();

// ตรวจสอบว่าผู้ใช้ล็อคอินหรือไม่
if (!isset($_SESSION['user_id'])) {
    // ถ้าไม่ได้ล็อคอิน ให้ redirect ไปหน้า login
    header("Location: index.php");
    exit;
}

// สร้าง session ใหม่เพื่อเพิ่มความปลอดภัย
session_regenerate_id(true);

// แสดงข้อมูลผู้ใช้จาก session พร้อมป้องกัน XSS
$full_name = htmlspecialchars($_SESSION['full_name'], ENT_QUOTES, 'UTF-8');
$balance = $_SESSION['balance'] ?? 0;
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กระเป๋าเงิน - คาสิโนออนไลน์</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, #FF0000, #FF7F00, #FFFF00, #00FF00, #0000FF, #4B0082, #8B00FF);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .wallet-container {
            background-color: rgba(0, 0, 0, 0.9);
            padding: 20px;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.5);
        }
        .wallet-header {
            font-size: 20px;
            font-weight: bold;
            color: #FFD700;
            margin-bottom: 15px;
        }
        .balance-container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 50%;
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 26px;
            font-weight: bold;
            color: #FFFFFF;
        }
        .menu {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .menu-item {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
        }
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .menu-item img {
            width: 40px;
            height: 40px;
            margin-bottom: 5px;
        }
        .btn-logout {
            margin-top: 20px;
            padding: 10px 15px;
            background: linear-gradient(90deg, #ff416c, #ff4b2b);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-logout:hover {
            background: linear-gradient(90deg, #ff4b2b, #ff416c);
        }
    </style>
</head>
<body>
    <div class="wallet-container">
        <div class="wallet-header">ชื่อผู้ใช้: <?php echo $full_name; ?></div>
        <div class="balance-container"><?php echo number_format($balance, 2); ?> บาท</div>
        <div class="menu">
            <div class="menu-item" onclick="window.location.href='wallet_system.php';">
                <img src="icons/deposit.png" alt="ฝากเงิน">
                <div>ฝากเงิน</div>
            </div>
            <div class="menu-item" onclick="window.location.href='withdraw_system.php';">
                <img src="icons/withdraw.png" alt="ถอนเงิน">
                <div>ถอนเงิน</div>
            </div>
            <div class="menu-item" onclick="window.location.href='https://www.ssgame350e.org/sagaming-demo/';">
                <img src="icons/play.png" alt="เข้าเล่น">
                <div>เข้าเล่น</div>
            </div>
            <div class="menu-item">
                <img src="icons/promotion.png" alt="โปรโมชั่น">
                <div>โปรโมชั่น</div>
            </div>
            <div class="menu-item">
                <img src="icons/event.png" alt="กิจกรรม">
                <div>กิจกรรม</div>
            </div>
            <div class="menu-item">
                <img src="icons/history.png" alt="ประวัติ">
                <div>ประวัติ</div>
            </div>
            <div class="menu-item">
                <img src="icons/reward.png" alt="รับทรัพย์">
                <div>รับทรัพย์</div>
            </div>
        </div>
        <button class="btn-logout" onclick="window.location.href='logout.php';">ออกจากระบบ</button>
    </div>
</body>
</html>
