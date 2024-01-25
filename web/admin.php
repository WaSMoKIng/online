<?php 

 session_start();
include 'config/shopping_cart.php';

$query = mysqli_query($conn, "SELECT * FROM products");
$rows = mysqli_num_rows($query);

$result = [
    'id' => '',
    'product_name' => '',
    'price' => '',
    'detail' => '',
    'product_image' => ''
];

if(!empty($_GET['id'])) {
    $query_product = mysqli_query($conn, "SELECT * FROM products WHERE id='{$_GET['id']}'");
    $row_product = mysqli_num_rows($query_product);
    
    if($row_product == 0) {
        header('location: admin.php');
    }

    
    $result = mysqli_fetch_ASSOC($query_product);

    // var_dump($result);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="a.css">
</head>
<body>
   <button onclick="window.location.href='index.php'"class="home-btn">หน้าหลัก</button>
   
   <div class="cont">
    <h4>จัดการข้อมูล</h4>
    <form action="product-form.php" method="post" enctype="multipart/form-data"> 
        <input type="hidden" name="id" value="<?php echo $result['id']?>">
        <input type="text" name="product_name" value="<?php echo $result['product_name']?>" placeholder="ชื่อสินค้า">
        <input type="text" name="price" value="<?php echo $result['price']?>" placeholder="ราคา">
        <label for="formfile">รูปภาพ</label>
        <?php if(!empty($result['profile_image'])):?>
            <img src="upload_image/<?php echo $result['profile_image']; ?> " width="100" alt="Product Image">
        <?php endif;?>

        <input type="file" name="profile_image" accept="image/png,image/jpg,image/jpeg" style="background-color: #DEF5E5; border:none;">
        <textarea name="detail" rows="3"  placeholder="คำอธิบาย" ><?php echo $result['product_name']?> </textarea>
        <?php if(empty($result['id'])):?>
        <button type="submit">สร้าง</button>
        <?php else: ?>
        <button type="submit">อัพเดท</button>
        <?php endif;?>
        

        <a type="submit" onclick="window.location.href='admin.php'">ยกเลิก</a>
    </form>
    <hr>
    <div class="show">
        <table>
            <thead>
                <tr>
                    <th style="width: 100px;">img</th>
                    <th>ชื่อสินค้า</th>
                    <th style="width: 200px;">ราคา</th>
                    <th style="width: 200px;">action</th>
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
                        <a role="button" href="admin.php?id=<?php echo $product['id']?>">แก้ไข</a>
                        <a onclick="return confirm('ยืนยันที่จะลบ')"role="button" href="product-delete.php?id=<?php echo $product['id']?>">ลบ</a>
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
</body>

</html>

