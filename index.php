<?php
// กำหนดค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "casino_db";  // ชื่อฐานข้อมูลของคุณ

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คาสิโนออนไลน์ - ล็อคอิน</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #FF0000, #FF7F00, #FFFF00, #00FF00, #0000FF, #4B0082, #8B00FF); /* สีรุ้ง */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }
        .login-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            width: 300px;
            text-align: center;
            position: relative;
        }
        h2 {
            font-size: 24px;
            background: linear-gradient(to left, #FF0000, #FF7F00, #FFFF00, #00FF00, #0000FF, #4B0082, #8B00FF); /* ข้อความสีรุ้ง */
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 20px;
            font-family: 'Impact', sans-serif;
        }
        .input-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 14px;
            color: #FFD700;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #333;
            color: white;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #D32F2F;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-family: 'Impact', sans-serif;
        }
        .btn:hover {
            background-color: #B71C1C;
        }
        .error-message {
            color: red;
            font-size: 12px;
            text-align: center;
        }
        .avengers-logo {
            width: 120px; /* ขนาดโลโก้ */
            margin-bottom: 20px;
        }
        .register-link {
            margin-top: 15px;
            font-size: 14px;
            color: #FFD700;
        }
        .register-link a {
            color: #FFD700;
            text-decoration: none;
            font-weight: bold;
        }
        /* เพิ่มสไตล์สำหรับไอคอน LINE */
        .contact-line {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            background-color: #00C300;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
        }
        .contact-line img {
            width: 30px;
            height: 30px;
        }
        .contact-line a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
        }

        /* การเคลื่อนไหวข้อความโปรโมชันที่เลื่อนจากขวาลงมา */
        .promo-text {
            position: absolute;
            top: -100%;
            right: 0;
            font-size: 20px;
            font-family: 'Impact', sans-serif;
            color: transparent;
            background: linear-gradient(to left, #FF0000, #FF7F00, #FFFF00, #00FF00, #0000FF, #4B0082, #8B00FF);
            -webkit-background-clip: text;
            animation: slideFromRight 5s ease-in-out infinite, bounceDown 2s 5s infinite;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }

        @keyframes slideFromRight {
            0% {
                right: -100%;
                top: -100%;
            }
            50% {
                right: 0;
                top: 20%;
            }
            100% {
                right: 0;
                top: 100%;
            }
        }

        /* การเคลื่อนไหวลูกบอล */
        .ball {
            position: absolute;
            right: -50px;
            top: 100px;
            width: 50px;
            height: 50px;
            background-color: #FFD700;
            border-radius: 50%;
            animation: kickBall 4s ease-in-out infinite, ballMoveDown 5s infinite;
        }

        @keyframes kickBall {
            0% {
                right: -50px;
                top: 100px;
            }
            50% {
                right: 50%;
                top: 100px;
            }
            100% {
                right: 100%;
                top: 100px;
            }
        }

        @keyframes ballMoveDown {
            0% {
                top: 100px;
            }
            50% {
                top: 50%;
            }
            100% {
                top: 100vh;
            }
        }

    </style>
</head>
<body>

    <div class="login-container">
        <!-- โลโกคาสิโนออนไลน์ -->
        <img src="images.png" alt="VEGUS96" class="avengers-logo">
        <h2>เข้าสู่ระบบคาสิโนออนไลน์</h2>
        <form action="login_action.php" method="POST">
            <div class="input-group">
                <label for="phone">เบอร์มือถือ:</label>
                <input type="text" id="phone" name="phone" placeholder="กรุณากรอกเบอร์มือถือ" required>
            </div>
            <div class="input-group">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" id="password" name="password" placeholder="กรุณากรอกรหัสผ่าน" required>
            </div>
            <button type="submit" class="btn">เข้าสู่ระบบ</button>
        </form>
        <p class="error-message">*กรุณาตรวจสอบข้อมูลให้ถูกต้อง</p>
        
        <!-- ปุ่มสมัครสมาชิก -->
        <div class="register-link">
            <p>ยังไม่ได้เป็นสมาชิก? <a href="register.php">สมัครสมาชิกที่นี่</a></p>
        </div>
    </div>

    <!-- เพิ่มข้อความโปรโมชัน -->
    <div class="promo-text">
        🎲ทุนน้อย กำไรงาม💸<br>
        ✅โปรโมชั่นสุดปังที่ไม่ควรพลาด<br>
        🔴ฝากต่อเนื่อง รับเพิ่ม 200 บาท<br>
        🔴ฝากบิลแรก รับเพิ่มอีก 10%<br>
        ✔️คุ้มแล้วคุ้มอีก
    </div>

    <!-- เพิ่มลูกบอลที่เคลื่อนไปจากขวามาซ้ายและตกลง -->
    <div class="ball"></div>

    <!-- เพิ่มไอคอน LINE สำหรับติดต่อเรา -->
    <div class="contact-line">
        <a href="https://line.me/ti/p/~bmwx4567" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Line_logo_2020.png" alt="LINE">
            ติดต่อเรา
        </a>
    </div>

</body>
</html>
