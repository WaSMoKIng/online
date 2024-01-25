<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUJUTSU KAISEN</title>
    <link rel="stylesheet" href="b.css">
</head>
<body>
    <nav>
            <button onclick="window.location.href='../index.php'">
            ย้อนกลับ
             </button>
    </nav>

    <div class="con">
        <div class="img">
            <img src="../img/jujutsu-kaisen.png" alt="">
        </div>

        <div class="info">
            <div class="text">
                <h2>JUJUTSU KAISEN</h2>
                <hr>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem praesentium modi recusandae quam et maxime dignissimos tempore quae eligendi. Voluptatum rerum iure ex sequi repellat placeat cupiditate libero fuga pariatur.</p>
            </div>
            <br>
            <form action="add" method="post">
            <p>1.99$</p>
                <br>
        <button name="buy" type="sumbit" class="buy">
            เพิ่มลงตระกร้า
        </button>

            </form>

        </div>
    </div>
    <button onclick="window.location.href='cart/cart.php'" class="cart-btn">
    ตระกร้า
        </button>
</body>
</html>