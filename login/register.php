<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../css/register.css">
    <title>Register</title>
    <?php 
        include_once("../allphp/php.php"); 
        include_once("../allphp/database.php");
        $conn = connection();
    ?>
</head>

<style>
    body{
        background-image: url("../assets/background.png");
        background-color: white;
        height: 900px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }
    
</style>

<body style="overflow: hidden;">
    <?php
    register(); // Call the register function
    ?>
    <header>
        <div class="bovenbalk"></div>
    </header>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form style=" position:absolute; width: 23rem; top: 9%;" method="POST">

                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register</h3>

                            <?php
                            if ($error) {
                                echo '<div class="alert alert-danger">' . $error . '</div>';
                            }
                            ?>

                            <div class="form-outline mb-4">
                                <input type="text" id="form2Example28" class="form-control form-control-lg"
                                    name="name" required />
                                <label class="form-label" for="form2Example28">Name</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="email" id="form2Example18" class="form-control form-control-lg"
                                    name="email" required />
                                <label class="form-label" for="form2Example18">Email address</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="form2Example28" class="form-control form-control-lg"
                                    name="password" required />
                                <label class="form-label" for="form2Example28">Password</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="form2Example28" class="form-control form-control-lg"
                                    name="address" required />
                                <label class="form-label" for="form2Example28">Address</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="form2Example28" class="form-control form-control-lg"
                                    name="zipcode" required />
                                <label class="form-label" for="form2Example28">Zipcode</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="tel" id="form2Example28" class="form-control form-control-lg"
                                    name="phone" required />
                                <label class="form-label" for="form2Example28">Phone number</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button style="left:60%;" class="btn btn-info btn-lg btn-block" type="submit">Register</button>
                            </div>

                            <a href="login.php">
                                <div class="pt-12 mb-4">
                                    <button style="position:absolute; left: 5%; bottom:-3.5%;" class="btn btn-info btn-lg btn-block" type="submit">Back to login</button>
                                </div>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>