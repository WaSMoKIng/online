<?php 
session_start();
require_once '../config/register.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="registerstyle.css">
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
        <form action="registerdb.php" method="post">
            <input type="firstname" placeholder="ชื่อจริง" name="firstname">
            <input type="lastname" placeholder="นามสกุล" name="lastname">
            <input type="email" placeholder="อีเมล" name="email">
            <input type="password" placeholder="รหัสผ่าน" name="password">
            <input type="password" placeholder="ยืนยันรหัสผ่าน" name="c_password">
        <button type="submit "name="register">สมัครสมาชิก</button>
        </form>
        <br>มีบัญชีผู้ใช้แล้ว <a href="../login/login.php">คลิ๊กที่นี้</a>
    </div>
</body>
</html>