<?php
include_once ("database.php");

// Establish the database connection
$conn = connection();
$error = ""; // Declare the $error variable
function recaptcha($POST)
{
    $secretKey = '6LdY5YIpAAAAALfCIfLdbxtNxSeZFpqzVlhSrbQs';
    $captcha = $POST['g-recaptcha-response'];

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    return $responseKeys["success"];
}

// Called when logging in
function login()
{
	// accessing variables outside of function
    global $conn, $error;

	// stop all current php code if there is no connection
    if (!$conn) {
        die ("Connection failed: " . $conn->errorInfo());
    }

	// only if the page is called via post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// recaptcha check
        if (!recaptcha($_POST)) {
            $error = "Invalid captcha robot boy little robot boy boy";
            header("Location: login.php");
            die();
        }
		
		// form info
        $email = $_POST['email'];
        $password = $_POST['password'];

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

// Called when regisetering
function register()
{
    global $conn, $error;

	// stop php code if there is no connection
    if (!$conn) {
        die ("Connection failed: " . $conn->errorInfo());
    }

	// only if the page is called via post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// form variables
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $zipcode = $_POST['zipcode'];
        $phone = $_POST['phone'];

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

// Called when password was forgotton
function handleForgotPassword($conn)
{
	// only if page is called via post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// form variables
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

// called when creating a new afspraak
function handleAfspraak($conn)
{
	// only if page is called via post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// check if all fields are set in post
        if (isset($_POST["name"]) && isset($_POST["date"]) && isset($_POST["description"]) && isset($_POST["address"])) {
			// form variables
            $naam = $_POST["name"];
            $datum = $_POST["date"];
            $beschrijving = $_POST["description"];
            $address = $_POST["address"];
            $user_id = $_SESSION['user_id'];

			// inserting the afspraak into the database
            try {
                $sql = "INSERT INTO afspraken (name, date, description, address, user_id) VALUES (:name, :date, :description, :address, :user_id)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':name', $naam);
                $stmt->bindParam(':date', $datum);
                $stmt->bindParam(':description', $beschrijving);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':user_id', $user_id);

                $stmt->execute();
                

                // Redirect to another page with a query parameter indicating form submission
                echo '<script>window.location.href = "index.php?submitted=true";</script>';
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            $GLOBALS["AFSPRAAK_ERROR"] = "Alle velden moeten worden ingevuld.";
        }
    } else {
        $GLOBALS["AFSPRAAK_ERROR"] = "Ongeldige aanvraag.";
    }
}

// called when a user updates their data
function update_user()
{
    $db = connection();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $user_id = $_GET['id'];
        $new_username = $_POST['new_username'];
        $new_address = $_POST['new_address'];
        $new_email = $_POST['new_email'];
        $new_password = $_POST['new_password'];
        $new_phone = $_POST['new_phone'];
        $new_zipcode = $_POST['new_zipcode'];

        $query = "UPDATE user SET name=:name, adress=:adress, email=:email, password=:password, phonenumber=:phonenumber, zipcode=:zipcode WHERE id=:id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $new_username);
        $stmt->bindParam(':adress', $new_address);
        $stmt->bindParam(':email', $new_email);
        $stmt->bindParam(':password', $new_password);
        $stmt->bindParam(':phonenumber', $new_phone);
        $stmt->bindParam(':zipcode', $new_zipcode);
        $stmt->bindParam(':id', $user_id);

        if ($stmt->execute()) {

            header("Location: useroverview.php");
            exit();
        } else {
            echo "Error updating user: " . $stmt->errorInfo()[2];
        }

        $stmt->closeCursor();

        $db = null;
    }
}

function update_product()
{
    $db = connection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_GET['id'];
        $new_username = $_POST['new_name'];
        $new_address = $_POST['new_description'];
        $new_email = $_POST['new_price'];
        $new_password = $_POST['new_image'];

        $query = "UPDATE products SET name=:name, description=:description, price=:price, image=:image WHERE id=:id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $new_username);
        $stmt->bindParam(':description', $new_address);
        $stmt->bindParam(':price', $new_email);
        $stmt->bindParam(':image', $new_password);
        $stmt->bindParam(':id', $user_id);

        if ($stmt->execute()) {
            header("Location: productoverview.php");
            exit();
        } else {

            echo "Error updating user: " . $stmt->errorInfo()[2];
        }

        $stmt->closeCursor();

        $db = null;
    }

}

function update_userpage()
{
    $db = connection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_id = $_SESSION['user_id'];
        $new_username = $_POST['new_username'];
        $new_address = $_POST['new_address'];
        $new_email = $_POST['new_email'];
        $new_password = $_POST['new_password'];
        $new_phone = $_POST['new_phone'];
        $new_zipcode = $_POST['new_zipcode'];

        $query = "UPDATE user SET name=:name, adress=:adress, email=:email, password=:password, phonenumber=:phonenumber, zipcode=:zipcode WHERE id=:id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $new_username);
        $stmt->bindParam(':adress', $new_address);
        $stmt->bindParam(':email', $new_email);
        $stmt->bindParam(':password', $new_password);
        $stmt->bindParam(':phonenumber', $new_phone);
        $stmt->bindParam(':zipcode', $new_zipcode);
        $stmt->bindParam(':id', $user_id);

        if ($stmt->execute()) {

            exit();
        } else {

            echo "Error updating user: " . $stmt->errorInfo()[2];
        }

        $stmt->closeCursor();

        $db = null;
    }
}

function getCurrentUsername($conn) {
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT name FROM user WHERE id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($row) ? $row["name"] : "Guest";
}

function displayAppointmentsForCurrentUser($conn) {
    $user_id = $_SESSION["user_id"];
    $query = "SELECT id, name, date, description, address
              FROM afspraken
              WHERE user_id = :user_id
              ORDER BY date DESC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo "<table>";
        echo "<tr>
                <th>Naam</th>
                <th>Datum</th>
                <th>Beschrijving</th>
                <th>Adres</th>
              </tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Check if the date is in the past
            $date = strtotime($row["date"]);
            $today = strtotime(date("Y-m-d"));
            $date_class = ($date < $today) ? 'past-date' : '';
            echo "<tr class='$date_class'><td>" . $row["name"] . "</td><td>" . $row["date"] . "</td><td>" . $row["description"] . "</td><td>" . $row["address"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No appointments found for the current user.";
    }
}

?>
