<?php 
session_start();
require_once '../config/register.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
</head>
<body>
    <div class="login-con">
        <h1>สมัครสมาชิก</h1>
        <?php if(isset($_SESSION['error'])) { ?>
            <?php 
            echo $_SESSION['error'];    
            unset($_SESSION['error']);    
            ?>
        <?php } ?>
        <?php if(isset($_SESSION['warning'])) { ?>
            <?php 
            echo $_SESSION['warning'];    
            unset($_SESSION['warning']);    
            ?>
        <?php } ?>
        <?php if(isset($_SESSION['success'])) { ?>
            <?php 
            echo $_SESSION['success'];    
            unset($_SESSION['success']);    
            ?>
        <?php } ?>
        <form action="logindb.php" method="post">
            <input type="email" placeholder="อีเมล" name="email">
            <input type="password" placeholder="รหัสผ่าน" name="password">
        <button type="submit "name="login">เข้าสู่ระบบ</button>
        </form>
        <br>ยังไม่มีบัญชีผู้ใช้ <a href="../register/register.php">คลิ๊กที่นี้</a>
    </div>
</body>
</html>