<?php
include 'include/pdo.php';
$db = new Connexion('projet', 'app', 'test');
$ids = $db->q("SELECT DISTINCT id_commune FROM QUANTITE_PRODUITE");
?>
<!doctype html>
<html lang="fr">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Thibaud Cheruy & Morgan Jutteau">
    <title>Communauté de commune du Grésivaudan</title>

    <link rel="canonical" href="index.html">



    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


</head>
<body>

<main>
    <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
            <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Communauté de commune du Grésivaudan</span>
            </a>
        </header>

        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Historique du traitement des déchets</h1><br><br>
                <?php
                foreach($ids as $id){
                    ?><img src="graph.php?type=chiffre&id=<?=$id->id_commune?>"><?php
                }
                ?>
            </div>
        </div>

        <footer class="pt-3 mt-4 text-muted border-top">
            &copy; 2021
        </footer>
    </div>
</main>



</body>
</html>
