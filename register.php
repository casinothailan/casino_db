<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก - คาสิโนออนไลน์</title>
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
        }
        .register-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            width: 300px;
            text-align: center;
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
        input, select {
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
        input:focus, select:focus {
            color: #FFD700; /* สีตัวอักษรเมื่อมีการพิมพ์ */
            background-color: #444; /* เปลี่ยนสีพื้นหลังเมื่อเลือกหรือพิมพ์ */
            outline: none;
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
            width: 100px; /* ขนาดโลโก้ */
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
        .btn-back {
            margin-top: 15px;
            padding: 10px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-back:hover {
            background-color: #1976D2;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <!-- โลโกคาสิโนออนไลน์ที่หามาจากอินเตอร์เน็ต -->
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Avengers_logo.svg" alt="Avengers Logo" class="avengers-logo">
        <h2>สมัครสมาชิก คาสิโนออนไลน์</h2>
        <form action="register_action.php" method="POST">
            <div class="input-group">
                <label for="phone">เบอร์มือถือ:</label>
                <input type="text" id="phone" name="phone" placeholder="กรุณากรอกเบอร์มือถือ" required>
            </div>
            <div class="input-group">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" id="password" name="password" placeholder="กรุณากรอกรหัสผ่าน" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">ยืนยันรหัสผ่าน:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน" required>
            </div>
            <div class="input-group">
                <label for="bank_name">ชื่อธนาคาร:</label>
                <select id="bank_name" name="bank_name" required>
                    <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
                    <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
                    <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
                    <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                    <option value="ธนาคารกรุงศรีอยุธยา">ธนาคารกรุงศรีอยุธยา</option>
                    <option value="ธนาคารธนชาต">ธนาคารธนชาต</option>
                </select>
            </div>
            <div class="input-group">
                <label for="account_number">เลขที่บัญชี:</label>
                <input type="text" id="account_number" name="account_number" placeholder="กรุณากรอกเลขที่บัญชี" required>
            </div>
            <div class="input-group">
                <label for="full_name">ชื่อนามสกุล:</label>
                <input type="text" id="full_name" name="full_name" placeholder="กรุณากรอกชื่อนามสกุล" required>
            </div>
            <button type="submit" class="btn">สมัครสมาชิก</button>
        </form>

        <!-- เพิ่มปุ่มกลับไปหน้าล็อกอิน -->
        <button class="btn-back" onclick="window.location.href='index.php';">กลับไปหน้าล็อกอิน</button>

        <p class="error-message">*กรุณาตรวจสอบข้อมูลให้ถูกต้อง</p>
    </div>

</body>
</html>

