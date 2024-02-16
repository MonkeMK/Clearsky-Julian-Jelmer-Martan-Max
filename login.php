<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link rel="stylesheet" href="../Clearsky-Julian-Jelmer-Martan-Max/css/login.css">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <?php
    include_once("php.php");
    include_once("database.php");
    $conn = connection();
    ?>
</head>
<style>
    body{
        background-image: url("../Clearsky-Julian-Jelmer-Martan-Max/assets/background.png");
        background-color: white;
        height: 900px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }
    
</style>

<body>
    <?php
    login(); // Call the login function
    ?>
    <header>
        <div class="bovenbalk"></div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">

                    <div class="d-flex h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form style="width: 23rem;" method="POST">

                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                            <?php
                            if ($error) {
                                echo '<div class="alert alert-danger">' . $error . '</div>';
                            }
                            ?>

                            <div class="form-outline mb-4">
                                <input type="email" id="form2Example18" class="form-control form-control-lg"
                                    name="email" required />
                                <label class="form-label" for="form2Example18">Email address</label>
                            </div>

                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="password" id="form2Example28" class="form-control form-control-lg password-input" name="password" required />
                                    <button type="button" class="btn btn-light password-toggle-btn" onclick="togglePasswordVisibility()">
                                    <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                                <label class="form-label" for="form2Example28">Password</label>
                                </div>


                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                            </div>

                            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="forgotpassword.php">Forgot
                                    password?</a></p>
                            <p>Don't have an account? <a href="register.php" class="link-info">Register here</a></p>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
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
    </scrip>
</body>

</html>