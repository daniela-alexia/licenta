<?php
require_once "ShoppingCart.php";?>
<HTML>
<HEAD>
    <TITLE>Creare cos cumparaturi </TITLE>
    <link href="Style.css" type="text/css" rel="stylesheet" />
<style type="text/css">

    .txt-headinglabel{
        text-align: center;
        font-size: 90px;
    }

    .product-item {
        text-align: center;
        font-size: 30px;
    }


    body {
        background-attachment: fixed;
        background-image: url('partitura.jpg');
        background-size: 300px 200px;
        background-repeat: no-repeat;
        background-position: center;
        margin: 0px;
        -moz-background-size:cover;
-webkit-background-size:cover;
-o-background-size:cover;
background-size:cover;

}
#id1 {
    font-size: 30px;
}
</style>

</HEAD>
<BODY>
    <div id="id1">
        <a href="logout.php"><i class="fas fa-sign-outalt"></i>Logout</a>
    </div>
<div id="product-grid">
    <div class="txt-heading"><div class="txt-headinglabel">Products</div></div>
    <?php
    $shoppingCart = new ShoppingCart();
    $query = "SELECT * FROM tbl_product";
    $product_array = $shoppingCart->getAllProduct($query);
    if (! empty($product_array)) {
    foreach ($product_array as $key => $value) {
    ?>
    <div class="product-item">
        <form method="post" action="cos.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
            <div class="product-image">
                <img style="width: 100px; "src="<?php echo 'imagini/'.$product_array[$key]["image"]; ?>" width="500" height="200">
            </div>
            <div>
                <strong><?php echo $product_array[$key]["name"];
                    ?></strong>
            </div>
            <div class="product-price"><?php echo
                    $product_array[$key]["price"] . " RON"; ?></div>
            <div>
                <input type="text" name="quantity" value="1" size="2" />
                <input type="submit" value="Add to cart"
                       class="btnAddAction" />
            </div>

        </form>
    </div>
    
        <?php
    }
    }
    ?>
</div>
</BODY>
</HTML>