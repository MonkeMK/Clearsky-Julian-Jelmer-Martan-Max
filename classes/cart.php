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

    public function checkout($email, $country, $surname, $lastname, $zipcode, $housenumber, $streetname, $place, $phonenumber)
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
        $query = "INSERT INTO bestellingen (email, land, voornaam, achternaam, postcode, huisnummer, straatnaam, plaats, telefoonnummer) VALUES (:email, :country, :voornaam, :achternaam, :zipcode, :huisnummer, :straatnaam, :place, :telefoonnummer)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':voornaam', $surname);
        $stmt->bindParam(':achternaam', $lastname);
        $stmt->bindParam(':zipcode', $zipcode);
        $stmt->bindParam(':huisnummer', $housenumber);
        $stmt->bindParam(':straatnaam', $streetname);
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':telefoonnummer', $phonenumber);
        $stmt->execute();

        $user_id = $conn->lastInsertId();
    } else {
        $user_id = $_SESSION["user_id"];
    }

    $this->flush();
}
}
?>