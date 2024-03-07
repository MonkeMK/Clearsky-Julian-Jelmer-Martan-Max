<?php

class cart
{
    private $cart = [];

    private $items = array();

    function __construct()
    {
        session_start();
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            $this->cart = $_SESSION['cart'];
        } else {
            $this->cart = [];
        }
    }


    public function getCart()
    {
        return $this->cart;
    }

    public function addItem($id)
    {
        $item = ['id' => $id, 'quantity' => 1]; // Initialize quantity
        $found = false;

        // Check if cart is empty
        if (empty($this->cart)) {
            $this->cart[] = $item;
            $_SESSION['cart'] = $this->cart;
            return;
        }

        // Iterate through cart items
        foreach ($this->cart as &$cartItem) {
            // Check if the current cart item matches the item being added
            if (isset($cartItem['id']) && $cartItem['id'] === $id) {
                $cartItem['quantity']++;
                $found = true;
                break;
            }
        }

        // If item not found, add it to the cart
        if (!$found) {
            $this->cart[] = $item;
        }

        // Update session cart data
        $_SESSION['cart'] = $this->cart;
    }
    public function deleteItem($key)
    {
        unset($this->cart[$key]);
        $_SESSION['cart'] = $this->cart;
    }

    public function getItem($key)
    {
        return $this->cart[$key];
    }

    public function flush()
    {
        unset($this->cart);
        $this->cart = []; // re init
        $_SESSION['cart'] = $this->cart;
    }



    public function emptyCart() {
        unset($this->cart);
        $this->cart = []; // re init
        $_SESSION['cart'] = $this->cart;
    }
}
?>