<?php

class Cart
{
    private $cart = [];

    public function __construct()
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
        $item = ['id' => $id, 'quantity' => 1]; // Initialize 'quantity' key
        $found = false;
        foreach ($this->cart as &$cartItem) {
            if (is_array($cartItem) && isset($cartItem['id']) && $cartItem['id'] === $id) {
                $cartItem['quantity']++;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $item['quantity'] = 1;
            $this->cart[] = $item;
        }
        $_SESSION['cart'] = $this->cart;
    }

    public function checkout($name, $email, $address, $zipcode)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clearsky";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";

            if (!$_SESSION["logged_in"]) {
                $sql = "INSERT INTO user (name, email, adress, zipcode) VALUES (:name, :email, :adress, :zipcode)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':adress', $address);
                $stmt->bindParam(':zipcode', $zipcode);
                $stmt->execute();

                $user_id = $conn->lastInsertId();
            } else {
                $user_id = $_SESSION["user_id"];
            }

            $this->flush();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Output error message for debugging
        }
    }

    public function flush()
    {
        unset($this->cart);
        $this->cart = []; // re init
        $_SESSION['cart'] = $this->cart;
    }
}

?>