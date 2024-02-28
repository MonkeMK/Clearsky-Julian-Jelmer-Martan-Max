<?php
include_once('classes/cart.php');
if (isset($_POST["checkout"]) && $_POST["checkout"] == 1) {
    $cart = new Cart();
    $cart->checkout($_POST["name"], $_POST["email"], $_POST["address"], $_POST["zipcode"]);
    header("Location: ../pizza/index.php?checkout=success");
}

include_once('header.php');
include_once("database.php");

?>

<style>
    .container {
        top:50%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form{
        position: absolute;
        left: 40%;
        top: 20%;
    }

    /* Other styles remain unchanged */
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        grid-gap: 10px;
        margin-top: 20px;
    }

    .card {
        max-width: 200px;
    }

    .titel {
        text-align: center;
        position: absolute;
        left: 40%;
        top: 15%;
    }

    .center-content {
        left: 50%;
        width: 100%;
        height: 100%;
        top: 20%;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        grid-gap: 10px;
        margin-top: 450px; /* Adjust the top margin to move the cards down */
    }
</style>

<div class="container">
    <div class="offcanvas-body">
        <div class="center-content">
            <div class="w-50">
                <h4 class="titel">Delivery Address</h4>
                <div class="form">
                    <form action="checkout.php" method="POST" style="display: flex; flex-direction: column; align-items: center;">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="zipcode" class="form-label">Zip code:</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" required>
                        </div>
                        <button type="submit" name="checkout" value="1" class="btn btn-primary" <?php if (empty($cart->getCart())) {
                            echo "disabled";
                        } ?>>Checkout</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap">
            <div class="float-end w-100">
                <h4 style="position:absolute; top:60%;">Cart</h4>
                <div class="card-grid">
                    <?php
                    $count = 0;
                    $totalPrice = 0;
                    
                    if (!empty($cart->getCart())) {
                        foreach ($cart->getCart() as $key => $item) {
                            $count++;

                            $conn = connection();
                            $stmt = $conn->prepare("SELECT price FROM products");
                            $stmt->execute();
                            $product = $stmt->fetch();

                            $price = $product['price'] * $item['quantity'];
                            $totalPrice += $price;
                            ?>

                            <div class="card">
                                <img src="assets/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-fluid m-4"
                                    style="max-width: 200px; max-height: 200px;">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $name; ?>
                                    </h5>
                                    <?php echo $description; ?><br>
                                    <?php echo number_format($price, 2); ?>
                                    <br>
                                    <a href="remove.php?key=<?php echo $key; ?>" class="btn btn-danger">Remove</a>
                                </div>
                            </div>
                        <?php }
                    } else {
                        echo "<p>You have not added any pizzas.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <br><br>
        <h3>Total Price:
            <?php echo number_format($totalPrice, 2); ?>
        </h3>
    </div>
</div>

<br>
<be>
