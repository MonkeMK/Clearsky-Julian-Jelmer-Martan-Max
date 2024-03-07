<?php
include_once("database.php");

// Establish the database connection
$conn = connection();
$error = ""; // Declare the $error variable

function recaptcha($POST) {
    $secretKey = '6LdY5YIpAAAAALfCIfLdbxtNxSeZFpqzVlhSrbQs';
    $captcha = $POST['g-recaptcha-response'];
    
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    return $responseKeys["success"];
}

function login()
{
    global $conn, $error;

    if (!$conn) {
        // Error handling for database connection
        die("Connection failed: " . $conn->errorInfo());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!recaptcha($_POST)) {
            $error = "Invalid captcha robot boy little robot boy boy";
            header("Location: login.php");
            die();
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        // Perform input validation and sanitization

        // Prepare the query to check if the user exists and can log in
        $query = "SELECT * FROM user WHERE email = :email AND password = :password AND can_login = 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch();

        if ($result) {
            // User exists and can log in, set session variables and redirect to the dashboard
            $_SESSION['user_id'] = $result["id"];
            $_SESSION["logged_in"] = 1;
            header("Location: index.php");
            exit();
        } else {
            // Invalid credentials or user cannot log in, update the error message
            $error = "Invalid email or password. Please try again.";
        }
    }
}


function register()
{
    global $conn, $error;

    if (!$conn) {
        // Error handling for database connection
        die("Connection failed: " . $conn->errorInfo());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $zipcode = $_POST['zipcode'];
        $phone = $_POST['phone'];

        // Perform input validation and sanitization

        // Prepare the query to insert the user into the database
        $query = "INSERT INTO user (name, email, password, adress, zipcode, phonenumber, can_login) VALUES (:name, :email, :password, :address, :zipcode, :phone, 1)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':zipcode', $zipcode);
        $stmt->bindParam(':phone', $phone);

        if ($stmt->execute()) {
            // Registration successful, set session variables and redirect to the dashboard
            $_SESSION['email'] = $email;
            header("Location: login.php");
            exit();
        } else {
            // Registration failed, update the error message
            $error = "Registration failed. Please try again.";
        }
    }
}

function handleForgotPassword($conn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the email and new password from the form
        $email = $_POST['email'];
        $newPassword = $_POST['password'];
        
        // Validate the email and perform necessary checks
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check if the email exists in the database
            $query = "SELECT * FROM user WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                // Update the user's password
                $updateQuery = "UPDATE user SET password = :password WHERE email = :email";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bindParam(':password', $newPassword);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
            } else {
                echo "Email not found.";
            }
        } else {
            echo "Invalid email format.";
        }
    }
}

function handleAfspraak($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["name"]) && isset($_POST["date"]) && isset($_POST["description"])) {
            $naam = $_POST["name"];
            $datum = $_POST["date"];
            $beschrijving = $_POST["description"];
            
<<<<<<< HEAD
            // Controleer of de geselecteerde datum al in de database aanwezig is
            $sql_check = "SELECT * FROM afspraken WHERE date = :date";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bindParam(':date', $datum);
            $stmt_check->execute();
            
            if ($stmt_check->rowCount() > 0) {
                $GLOBALS["AFSPRAAK_ERROR"] = "Op deze datum is al een afspraak gepland. Kies een andere datum.";
                return; // Stop de functie als de datum al in de database aanwezig is
            }
            
            // Voeg de afspraak toe aan de database
            $sql_insert = "INSERT INTO afspraken (name, date, description) VALUES (:name, :date, :description)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bindParam(':name', $naam);
            $stmt_insert->bindParam(':date', $datum);
            $stmt_insert->bindParam(':description', $beschrijving);
            
            if ($stmt_insert->execute()) {
                $GLOBALS["AFSPRAAK_ERROR"] = "Afspraak succesvol ingepland.";
            } else {
                $GLOBALS["AFSPRAAK_ERROR"] = "Er is een fout opgetreden bij het plannen van de afspraak.";
=======
            try {
                // Prepare the SQL statement with named placeholders
                $sql = "INSERT INTO afspraken (name, date, description) VALUES (:name, :date, :description)";
                $stmt = $conn->prepare($sql);
                
                // Bind values to named placeholders
                $stmt->bindParam(':name', $naam);
                $stmt->bindParam(':date', $datum);
                $stmt->bindParam(':description', $beschrijving);
                
                // Execute the statement
                $stmt->execute();
                
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
>>>>>>> 3149cbce13247c58ab4dad999e28e6c7d3620cd8
            }
        } else {
            $GLOBALS["AFSPRAAK_ERROR"] = "Alle velden moeten worden ingevuld.";
        }
    } else {
        $GLOBALS["AFSPRAAK_ERROR"] = "Ongeldige aanvraag.";
    }
}
<<<<<<< HEAD




=======
>>>>>>> 3149cbce13247c58ab4dad999e28e6c7d3620cd8
?>