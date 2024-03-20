<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <?php
    include_once ("php.php");
    include_once ("database.php");
    $conn = connection();
    session_start();
    ?>
</head>

<body>
    <?php
    login();
    ?>
    <header>
        <div class="bovenbalk">
            <div id="popupBar" class="alert alert-dismissible fade show" role="alert" style="display: none;">
        </div>
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">

                    <div class="d-flex h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form id="loginForm" style="width: 23rem;" method="POST">

                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                            <?php
                            if ($error) {
                                echo '<div class="alert alert-danger">' . $error . '</div>';
                            }
                            ?>

                            <div class="form-outline mb-4">
                                <input type="email" id="form2Example18" class="form-control form-control-lg"
                                    name="email">
                                <label class="form-label" for="form2Example18">Email adres</label>
                            </div>

                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="password" id="form2Example28"
                                        class="form-control form-control-lg password-input" name="password">
                                    <button type="button" class="btn btn-light password-toggle-btn"
                                        onclick="togglePasswordVisibility()">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                                <label class="form-label" for="form2Example28">Wachtwoord</label>
                            </div>

                            <div class="g-recaptcha" data-sitekey="6LdY5YIpAAAAAHdMKJbm3A_QQCN6w_9Qn3oveQnv"></div>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit"
                                    onclick="return validateForm(event)">Inloggen</button>
                            </div>

                            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="forgotpassword.php">Wachtwoord
                                    vergeten?</a></p>
                            <p>Heb je geen account? <a href="register.php" class="link">Registeer hier</a></p>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
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

    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("form2Example28");
        var passwordToggle = document.getElementById("passwordToggle");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordToggle.classList.remove("far", "fa-eye");
            passwordToggle.classList.add("fas", "fa-eye-slash");
        } else {
            passwordInput.type = "password";
            passwordToggle.classList.remove("fas", "fa-eye-slash");
            passwordToggle.classList.add("far", "fa-eye");
        }
    }

    function validateForm(event) {
        var email = document.getElementById("form2Example18").value;
        var password = document.getElementById("form2Example28").value;

        if (email.trim() === "" || password.trim() === "") {
            displayPopup("Alle velden moeten ingevuld zijn.");
            event.preventDefault();
            return false;
        }

        return true;
    }
        
    </script>
</body>

</html>