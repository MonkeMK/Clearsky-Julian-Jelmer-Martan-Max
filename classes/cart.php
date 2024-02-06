<?php

class cart
{
    private $cart = [];

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

    public function addItem($id, $size)
    {
        $item = ['id' => $id, 'size' => $size];
        $found = false;
        foreach ($this->cart as &$cartItem) {
            if ($cartItem['id'] === $id && $cartItem['size'] === $size) {
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
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

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
    }
}