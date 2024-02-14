<!DOCTYPE html>
<html lang="en">

<?php
    include_once("allphp/header.php");
    include_once('allphp/database.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearsky</title>
    <link rel="stylesheet" href="../Clearsky-Julian-Jelmer-Martan-Max/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="tekst1">Welkom bij Clearsky</h1>
                <p class="tekst2">Clearsky is een bedrijf dat zich specialiseert in het maken van zonnepanelen en het instaleren van zonnepanelen. Wij
                bieden een breed scala aan diensten aan, Het instaleren van kleine tot aan grote zonnepanelen. Wij bieden ook de mogelijkheid om een afspraak te maken voor een
                consultatie. Wij zullen dan samen met u kijken naar de mogelijkheden en de beste oplossing voor uw
                wensen.</p>
            </div>
        </div> 
        
        <div class="d-flex flex-wrap justify-content-around">
        <?php
        $conn = connection();

        $stmt = $conn->prepare("SELECT * FROM products LIMIT 6");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        foreach ($result as $r) {
            ?>
            <div class="card mx-5 mb-5" style="width: 20rem;">
                <div class="card-img-top d-flex align-items-center">
                    <div>
                        <img class="card-img-top p-2" src="assets/img/<?php echo $r['image']; ?>" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $r['name']; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $r['description']; ?>
                        </p>
                        <p class="card-text"><small class="text-muted">
                                <?php echo $r['price']; ?>
                            </small></p>
                        <a href="product.php?id=<?php echo $r['id']; ?>" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <?php

        }
        ?>
</body>
</html>













