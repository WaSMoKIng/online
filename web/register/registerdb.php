<?php 
    session_start();
    require_once '../config/register.php';

    if(isset($_POST['register'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $urole = 'user';

        if(empty($firstname)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อจริง';
            header("location: register.php");
        } else if(empty($lastname)) {
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header("location: register.php");
        } else if(empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: register.php");
        } else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: register.php");
        } else if(empty($password)) {
            $_SESSION['error'] = 'กรุณาใส่รหัสผ่าน';
            header("location: register.php" );
        }  else if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5 ) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาว 5 ถึง 20 ตัวอักษร';
            header("location: register.php");
        } else if(empty($c_password)) {
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: regiaster.php");
        }  else if($password != $c_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: register.php");
        } else {
            try {

                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) { 
                    $_SESSION['warning'] = 'มีเมลอยู่ในระบบแล้ว';
                    header("location: register.php");
                } elseif(!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, email, password, urole) VALUES(:firstname, :lastname, :email, :password, :urole)");

                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->execute();
                    $_SESSION['success'] = 'สมัครสมาชิกเรียบร้อย';
                    header("location: register.php");

                } else {
                    $_SESSION['error'] = 'มีบางอย่างผิดพลาด';
                    header("location: register.php");
                }
            } catch(PDOExcaption $e) {
                echo $e->getMassage();
            }
        }
    } 
?>