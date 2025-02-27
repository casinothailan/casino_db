<?php
// เริ่มต้น session
session_start();

// ลบข้อมูล session เพื่อออกจากระบบ
session_unset();
session_destroy();

// รีไดเรกต์กลับไปที่หน้าล็อคอิน
header("Location: index.php");
exit;
?>
