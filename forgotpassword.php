<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../Clearsky-Julian-Jelmer-Martan-Max/css/forgetpassword.css">
    <title>Forget password</title>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <?php 
        include_once("php.php"); 
        include_once("database.php");
        $conn = connection();
        handleForgotPassword($conn);
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
    <header>
        <div class="bovenbalk"></div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form style="width: 23rem;" method="POST">

                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Forgot Password</h3>

                            <div class="form-outline mb-4">
                                <input type="email" id="form2Example18" class="form-control form-control-lg"
                                    name="email" required />
                                <label class="form-label" for="form2Example18">Email address</label>
                            </div>

                            <div class="form-outline mb-4">
                                <div class="input-group">
                                    <input type="password" id="form2Example28" class="form-control form-control-lg"
                                        name="password" required />
                                    <button type="button" class="btn1 btn-light">
                                        <i id="passwordToggle" class="far fa-eye"></i>
                                    </button>
                                </div>
                                <label class="form-label" for="form2Example28">New Password</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit">DONE!!</button>
                            </div>

                        </form>
                        <a href="login.php">
                            <div class="pt-1 mb-4">
                                <button style="position:absolute; left: 35%; bottom:10%; align-items-center  background-color:#103E7E;" class="btn btn-info btn-lg btn-block" type="submit">Back to login</button>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</body>

</html>
