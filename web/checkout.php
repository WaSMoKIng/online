<?php
session_start();
require_once 'config/register.php'; 
include 'config/shopping_cart.php';

$productIds = [];
foreach(($_SESSION['cart'] ?? []) as $cartId => $cartQty) {
    $productIds[] = $cartId;
}

$ids = 0;
if(count($productIds) > 0) {
    $ids = implode(',',$productIds);
}

var_dump($ids);

$query = mysqli_query($conn, "SELECT * FROM products WHERE id IN($ids)");
$rows = mysqli_num_rows($query);
?>
-

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="s.css">
    <link rel="stylesheet" href="cart.css">
    <script src="search.js"></script>
</head>
<body>
    <nav>


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
<h4>ตระกร้าสินค้า</h4>
<form action="cart-update.php" method="post" >
        <table>
            <thead>
                <tr>
                    <th style="width: 100px;">รูปภาพ</th>
                    <th>ชื่อสินค้า</th>
                    <th style="width: 200px;">ราคา</th>
                    <th style="width: 100px;">จำนวน</th>
                    <th style="width: 200px;">ราคารวม</th>
                    <th style="width: 120px;"></th>
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
                    <td><input type="number" name="product[<?php echo $product['id']; ?>][quantity]" value="<?php echo $_SESSION['cart'][$product['id']];?>"></td>
                    <td>
                        <?php echo number_format($product['price'] * $_SESSION['cart'][$product['id']], 2);  ?>
                    </td>
                    <td>
                    <a onclick="return confirm('ยืนยันที่จะลบ')"role="button" href="cart-delete.php?id=<?php echo $product['id']?>">ลบ</a>
                        
                    </td>
                </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="6">
    
                            <button type="submit">อัพเดท</button>
                            <a href="/chackout.php">สั่งซื้อ</a>
                        
                    </td>
                </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="6">ไม่มีรายการสินค้าที่เลือก</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </form>

    </div>
   </div>
   <div class="btn-cart">
        <button onclick="window.location.href='cart.php'">
    ตระกร้า
        </button>
        </div>

        
</body>
</html>