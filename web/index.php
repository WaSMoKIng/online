<?php
session_start();
require_once 'config/register.php'; 
include 'config/shopping_cart.php';

$query = mysqli_query($conn, "SELECT * FROM products");
$rows = mysqli_num_rows($query);
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="s.css">
    <script src="search.js"></script>
</head>
<body>
    <nav>
    <div class="search">
        <input type="text" name="search" id="search" placeholder="ค้นหาหนังสือที่ต้องการ" onkeyup="search()">
    </div>
    <ul>
        
        <li><a href="">โรแมนติก</a></li>
        <li><a href="">แอ็คชั่น</a></li>
        <li><a href="">ปริศนา</a></li>
        <li><a href="">ตลก</a></li>
        <li><a href="">พลังพิเศษ</a></li>
        <li><a href="">สยองขวัญ</a></li>
    </ul>


    <div class="register-login">
        

        <button onclick="window.location.href='login/login.php';" <?php echo ($_SESSION['status'] == 1) ? 'style="display:none;"' : '' ?> >
                เข้าสู่ระบบ
            </button>
        <div <?php echo ($_SESSION['status'] == 0) ? 'style="display:none;"' : '' ?>>
        <button onclick="window.location.href='logout.php';" >
                ออกจากระบบ
            </button>
        </div>
        
    </div>

</nav>
<div class="show">
        <table>
            <thead>
                <tr>
                    <th style="width: 100px;">รูปภาพ</th>
                    <th>ชื่อสินค้า</th>
                    <th style="width: 200px;">ราคา</th>
                    <th style="width: 200px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php if($rows > 0):?> 
                    <?php while($product = mysqli_fetch_ASSOC($query)): ?>
                <tr>
                    <td>
                        <?php if(!empty($product['profile_image'])):?>
                            
                            <img src="upload_image/<?php echo $product['profile_image']; ?> " width="100" alt="Product Image">
                            
                        <?php else:?>
                            <img src="upload_image/3.jpg" width="100" alt="Product Image">
                            
                        <?php endif;?>
                    </td>
                    <td> <?php echo $product['product_name'];?>
                        <small><?php echo nl2br($product['detail']);?></small>
                    </td>
                    <td><?php echo number_format($product['price'], 2);?></td>
                    <td>
                        <a role="button" href="cart-add.php?id=<?php echo $product['id'] ?>">เพิ่มลงตระกร้า</a>
                        
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">ไม่มีรายการสินค้า</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>


    </div>
    </div>
   <div class="btn-cart">
        <button onclick="window.location.href='cart.php'">
    ตระกร้า
        </button>
        </div>
</body>
</html>