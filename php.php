<?php
include_once ("database.php");

$PASS_ENC = CRYPT_SHA256;
$PASS_SALT = "zI0nL2jH5pS8oF9qX6eO9fD6rF8kJ0nY";
$PASS_PEPPER = "hZ4lZ4uA0sC9cO6fE1jF6pY4gK8tY4sY";

// Maak de databaseverbinding
$conn = connection();
$error = ""; // De variabele $error wordt gedeclareerd

// Functie voor reCAPTCHA
function recaptcha($POST)
{
    $secretKey = '6LdY5YIpAAAAALfCIfLdbxtNxSeZFpqzVlhSrbQs';
    $captcha = $POST['g-recaptcha-response'];

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    return $responseKeys["success"];
}

// Functie inloggen
function login()
{
    global $conn, $error;
    global $PASS_PEPPER, $PASS_SALT, $PASS_ENC;

    // Stop de uitvoering van de code als er geen verbinding is
    if (!$conn) {
        die ("Verbinding mislukt: " . $conn->errorInfo());
    }

    // Alleen als de pagina wordt aangeroepen via post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Controleer reCAPTCHA
        if (!recaptcha($_POST)) {
            $error = "Ongeldige captcha.";
            header("Location: login.php");
            die();
        }

        // Formuliergegevens
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Bereid de query voor om te controleren of de gebruiker bestaat en kan inloggen
        $query = "SELECT * FROM user WHERE email = :email AND can_login = 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Haal het resultaat op
        $result = $stmt->fetch();

        if ($result) {
            // Gebruiker bestaat, controleer het wachtwoord
            if (password_verify($PASS_PEPPER . $password . $PASS_SALT, $result['password'])) {
                // Wachtwoord is correct, stel sessievariabelen in en leid door naar het dashboard
                $_SESSION['user_id'] = $result["id"];
                $_SESSION["logged_in"] = 1;
                header("Location: index.php");
                exit();
            } else {
                // Ongeldig wachtwoord
                $error = "Ongeldige e-mail of wachtwoord. Probeer het opnieuw.";
            }
        } else {
            // Gebruiker bestaat niet of kan niet inloggen
            $error = "Ongeldige e-mail of wachtwoord. Probeer het opnieuw.";
        }
    }
}

// Functie voor registreren
function register() {
    global $conn, $error, $PASS_PEPPER, $PASS_SALT, $PASS_ENC;

    // Stop de code als er geen verbinding is
    if (!$conn) {
        die ("Verbinding mislukt: " . $conn->errorInfo());
    }

    // Alleen als de pagina wordt aangeroepen via post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Formuliergegevens
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $place = $_POST['place'];  
        $zipcode = $_POST['zipcode'];
        $phone = $_POST['phone'];

        $hashed_passwd = password_hash($PASS_PEPPER . $password . $PASS_SALT, $PASS_ENC);

        // Bereid de query voor om de gebruiker in de database in te voegen
        $query = "INSERT INTO user (name, email, password, adress, place, zipcode, phonenumber, can_login, admin) VALUES (:name, :email, :password, :address, :place, :zipcode, :phone, 1, 0)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_passwd);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':zipcode', $zipcode);
        $stmt->bindParam(':phone', $phone);

        if ($stmt->execute()) {
            // Registratie succesvol, stel sessievariabelen in en leid door naar het dashboard
            $_SESSION['email'] = $email;
            header("Location: login.php"); // Redirect to login.php
            exit();
        } else {
            // Registratie mislukt, update het foutbericht
            $error = "Registratie mislukt. Probeer het opnieuw.";
        }
    }
}

// Functie voor behandelen van vergeten wachtwoord
function handleForgotPassword($conn)
{
    // Alleen als de pagina wordt aangeroepen via post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Formuliergegevens
        $email = $_POST['email'];
        $newPassword = $_POST['password'];

        // Valideer de e-mail en voer noodzakelijke controles uit
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Controleer of het e-mailadres in de database bestaat
            $query = "SELECT * FROM user WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Update het wachtwoord van de gebruiker
                $updateQuery = "UPDATE user SET password = :password WHERE email = :email";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bindParam(':password', $newPassword);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
            } else {
                echo "E-mail niet gevonden.";
            }
        } else {
            echo "Ongeldig e-mailformaat.";
        }
    }
}

// Functie voor behandelen van nieuwe afspraak
function handleAfspraak($conn)
{
    // Alleen als de pagina wordt aangeroepen via post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Controleer of alle velden zijn ingevuld in de post
        if (isset($_POST["name"]) && isset($_POST["date"]) && isset($_POST["description"]) && isset($_POST["address"])) {
            // Formuliergegevens
            $naam = $_POST["name"];
            $datum = $_POST["date"];
            $beschrijving = $_POST["description"];
            $address = $_POST["address"];
            $user_id = $_SESSION['user_id'];

            // Voeg de afspraak toe aan de database
            try {
                $sql = "INSERT INTO afspraken (name, date, description, address, user_id) VALUES (:name, :date, :description, :address, :user_id)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':name', $naam);
                $stmt->bindParam(':date', $datum);
                $stmt->bindParam(':description', $beschrijving);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':user_id', $user_id);

                $stmt->execute();

                // Doorsturen naar een andere pagina met een queryparameter die het verzenden van het formulier aangeeft
                echo '<script>window.location.href = "index.php?submitted=true";</script>';
            } catch (PDOException $e) {
                echo "Fout: " . $e->getMessage();
            }
        } else {
            $GLOBALS["AFSPRAAK_ERROR"] = "Alle velden moeten worden ingevuld.";
        }
    } else {
        $GLOBALS["AFSPRAAK_ERROR"] = "Ongeldige aanvraag.";
    }
}

// Functie voor het bijwerken van gebruikersgegevens
function update_user()
{
    $db = connection();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Formuliergegevens ophalen
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
            echo "Fout bij het bijwerken van gebruiker: " . $stmt->errorInfo()[2];
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

            echo "Fout bij het bijwerken van gebruiker: " . $stmt->errorInfo()[2];
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

            echo "Fout bij het bijwerken van gebruiker: " . $stmt->errorInfo()[2];
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
    return ($row) ? $row["name"] : "Gast";
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
		echo <<<EOT
		<tr>
			<th>Naam</th>
			<th>Datum</th>
			<th>Beschrijving</th>
			<th>Adres</th>
			<th>Calander</th>
		</tr>
		EOT;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Controleer of de datum in het verleden ligt
            $date = strtotime($row["date"]);
            $today = strtotime(date("Y-m-d"));
			$name = $row["name"];
            $date_class = ($date < $today) ? 'past-date' : '';
            echo "<tr class='$date_class'><td>" . $row["name"] . "</td><td>" . $row["date"] . "</td><td>" . $row["description"] . "</td><td>" . $row["address"] . "</td>";
			echo <<<EOT
				<add-to-calendar-button
					name="$name"
					options="'Apple','Google'"
					location="YEs"
					startDate="$date"
					endDate="$date"
					startTime="10:00"
					endTime="23:59"
					timeZone="America/Los_Angeles"
				></add-to-calendar-button></tr>
			EOT;
        }
        echo "</table>";
		echo <<<EOT
			<add-to-calendar-button
				name="Title"
				options="'Apple','Google'"
				location="World Wide Web"
				startDate="2024-03-30"
				endDate="2024-03-30"
				startTime="10:15"
				endTime="23:30"
				timeZone="America/Los_Angeles"
			></add-to-calendar-button>
		EOT;
    } else {
       
    }
}

function getCurrentUserData($conn) {
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT name, adress, email, phonenumber, zipcode, place FROM user WHERE id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

