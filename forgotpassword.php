<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/forgetpassword.css">
    <title>Wachtwoord vergeten?</title>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <?php
    include_once ("php.php");
    include_once ("database.php");
    $conn = connection();
    handleForgotPassword($conn);
    ?>
</head>

<body>
    <header>
        <div class="bovenbalk">
            <div id="popupBar" class="alert alert-dismissible fade show alert-warning" role="alert"
                style="display: none;">
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form style="width: 23rem;" method="POST" onsubmit="return validateForm(event);">

                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Wachtwoord vergeten?</h3>

                            <div class="form-outline mb-4">
                                <input type="email" id="email" class="form-control form-control-lg" name="email">
                                <label class="form-label" for="form2Example18">Email adres</label>
                            </div>

                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control form-control-lg"
                                        name="password">
                                    <button type="button" class="btn1 btn-light">
                                        <i id="passwordToggle" class="far fa-eye"></i>
                                    </button>
                                </div>
                                <label class="form-label" for="form2Example28">Nieuw wachtwoord</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit">KLAAR!!</button>
                            </div>

                        </form>
                        <a href="login.php">
                            <div class="pt-1 mb-4">
                                <button
                                    style="position:absolute; left: 35%; bottom:10%; align-items-center  background-color:#103E7E;"
                                    class="btn btn-info btn-lg btn-block" type="submit">Back to login</button>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</body>

<script>
    function validateForm(event) {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        if (email.trim() === "" || password.trim() === "") {
            displayPopup("Alle velden moeten ingevuld zijn.");
            event.preventDefault();
            return false;
        }

        return true;
    }

    function displayPopup(message) {
        var popupBar = document.getElementById("popupBar");
        popupBar.innerHTML = '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' + message;
        popupBar.style.display = "block";

        setTimeout(function () {
            popupBar.style.display = "none";
        }, 5000);
    }
</script>

</html>
