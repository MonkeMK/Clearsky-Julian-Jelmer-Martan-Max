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
    .center-content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        grid-gap: 20px;
    }
</style>
<?php

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1) {
    $sql = "SELECT * FROM user WHERE id = :id";
    $conn = connection();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $result = false;
}
?>

<div class="offcanvas-body">

    <div class="center-content">
        <div class="w-50">
            <h4>Delivery Address</h4>
            <form action="checkout.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php if ($result) {
                        echo $result["name"];
                    } ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php if ($result) {
                        echo $result["email"];
                    } ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php if ($result) {
                        echo $result["adress"];
                    } ?>" required>
                </div>
                <div class="mb-3">
                    <label for="zipcode" class="form-label">Zip code:</label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php if ($result) {
                        echo $result["zipcode"];
                    } ?>" required>
                </div>
                <!-- Checkout button -->
                <button type="submit" name="checkout" value="1" class="btn btn-primary" <?php if (empty($cart->getCart())) {
                    echo "disabled";
                } ?>>Checkout</button>
            </form>
        </div>
        <!-- </div> -->
    </div>

    <div class="d-flex flex-wrap">
        <div class="float-end w-100">
            <!-- Display pizzas in the cart -->
            <h4>Cart</h4>
            <div class="card-grid">
                <?php
                $count = 0;
                $totalPrice = 0; // Variable to store the total price
                
                if (empty($cart->getCart())) {
                    echo "<p>You have not added any pizzas.</p>";
                } else {
                    foreach ($cart->getCart() as $key => $item) {
                        $count++;

                        // Retrieve pizza details from the database based on the ID
                        $conn = connection();
                        $stmt = $conn->prepare("SELECT * FROM product WHERE id = :id");
                        $stmt->bindParam(':id', $item['id']);
                        $stmt->execute();
                        $pizza = $stmt->fetch();

                        $name = $pizza['name'];
                        $price = $pizza['price'];
                        $size = $item['size'];
                        $quantity = $item['quantity'];
                        $image = $pizza['image'];
                        $type = $pizza['type'];

                        // Calculate the price based on the pizza size
                        if ($size === 'S') {
                            $price *= 0.75;
                        } elseif ($size === 'L') {
                            $price *= 1.25;
                        }

                        if ($count > 1) {
                            $price *= 0.5;
                            $sale = "50% off!";
                        }

                        // Calculate the subtotal for the current pizza
                        $subtotal = $price * $quantity;

                        // Add the subtotal to the total price
                        $totalPrice += $subtotal;
                        ?>

                        <!-- Display the pizza card -->
                        <div class="card">
                            <img src="assets/img/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-fluid m-4"
                                style="max-width: 512px; max-height: 512px;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $name; ?>
                                </h5>
                                Price:
                                <?php echo number_format($price, 2); ?>
                                <?php if (isset($sale)) {
                                    echo $sale;
                                }
                                ; ?><br>
                                Size:
                                <?php echo $size; ?><br>
                                Quantity:
                                <?php echo $quantity; ?><br>
                                <p class="card-text">Type:
                                    <?php echo $type; ?>
                                </p>
                                <a href="remove.php?key=<?php echo $key; ?>" class="btn btn-danger">Remove</a>
                            </div>
                        </div>
                    <?php }
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

<br><br>
