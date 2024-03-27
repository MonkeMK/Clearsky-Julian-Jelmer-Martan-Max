<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <?php
    include_once ("php.php");
    include_once ("database.php");
    $conn = connection();
    ?>
</head>

<body style="overflow: hidden; position:relative;">
    <?php
    register(); // Call the register function
    ?>
    <header>
        <div class="bovenbalk">
            <div id="popupBar" class="alert alert-dismissible fade show" role="alert" style="display: none;">
            </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">
                    <div class="d-flexregister align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form id="registerForm" style=" position:absolute; width: 23rem; top: 9%;" method="POST">

                            <h3 class="fw-normalregister mb-3 pb-3" style="letter-spacing: 1px;">Registeren</h3>

                            <?php
                            if ($error) {
                                echo '<div class="alert alert-danger">' . $error . '</div>';
                            }
                            ?>

                            <div class="form-outline mb-4">
                                <input type="text" id="name" class="form-control form-control-lg" name="name">
                                <label class="form-label" for="name">Naam</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="email" id="email" class="form-control form-control-lg" name="email">
                                <label class="form-labelregister" for="email">Email adres</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" class="form-control form-control-lg"
                                    name="password">
                                <label class="form-labelregister" for="password">Wachtwoord</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="address" class="form-control form-control-lg" name="address">
                                <label class="form-labelregister" for="address">Adres</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="zipcode" class="form-control form-control-lg" name="zipcode">
                                <label class="form-labelregister" for="zipcode">Postcode</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="tel" id="phone" class="form-control form-control-lg" name="phone">
                                <label class="form-labelregister" for="phone">Telefoonnummer</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button style="left:60%;" class="btnregister btn-info btn-lg btn-block" type="button"
                                    onclick="validateForm()">Registeer</button>
                            </div>

                            <a href="login.php">
                                <div class="pt-12 mb-4">
                                    <button class="btnregister2 btn-info btn-lg btn-block" type="submit">Terug naar login</button>
                                </div>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var address = document.getElementById("address").value;
        var zipcode = document.getElementById("zipcode").value;
        var phone = document.getElementById("phone").value;

        if (name.trim() === "" || email.trim() === "" || password.trim() === "" || address.trim() === "" || zipcode.trim() === "" || phone.trim() === "") {
            displayPopup("Vul alle velden in alstublieft.");
            return false;
        }

        return true;
    }

    function displayPopup(message) {
            var popupBar = document.getElementById("popupBar");
            popupBar.innerHTML = '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' + message;
            popupBar.classList.add("alert-warning");
            popupBar.style.display = "block";

            // Hide the popup after 5 seconds
            setTimeout(function () {
                popupBar.style.display = "none";
            }, 5000);
        }
    </script>
</body>

</html>
