<?php 

    session_start();
    require_once '../config/register.php';

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header('location: login.php');
        } elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header('location: login.php');
        } elseif(empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header('location: login.php');
        } elseif(strlen($password) > 20 || strlen($password) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาว 5 ถึง 20 ตัวอักษร';
            header('location: login.php');
        }
         else {
            try {
                $check_data = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $check_data->bindParam(":email", $email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);
                if($check_data->rowCount() > 0) {
                    if($email == $row['email'] ) {
                    if (password_verify($password,$row['password'])) {
                       $_SESSION['login'] = $row['id'];
                       header('location: ../index.php');
                       $_SESSION['status'] = 1;
                    } else {
                        $_SESSION['warning'] = 'รหัสผ่านผิด';
                        header('location: login.php');
                    }
                } else {
                    $_SESSION['error'] = 'อีเมลผิด';
                        header('location: login.php');
                }
                } else {
                    $_SESSION['error'] = 'ไม่มีข้อมูลในระบบ';
                        header('location: login.php');
                }
            } catch(PDOExeception) {
                echo $e->getMassage();
            }
        }

    }
?>