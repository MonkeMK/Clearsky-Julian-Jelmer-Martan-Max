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