<?php
/*
    /!\ Pour pouvoir afficher le site, il faut modifier le fichier pdo.php situé dans le dossier include
    pour connecter votre base de donnée
*/
include 'include/pdo.php';
$db = new Connexion();
$recettes = $db->qone("SELECT SUM(montant) AS montant FROM A_RAPORTE WHERE année = 2018");
$depenses = $db->qone("SELECT SUM(montant) AS montant FROM A_DEPENSE WHERE année = 2018");
$tonnes = $db->qone("SELECT SUM(quantite) AS quantite FROM QUANTITE_PRODUITE WHERE année = 2018");
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
            <a href="" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Communauté de commune du Grésivaudan</span>
            </a>
        </header>

        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Bienvenue sur le site de la gestion des déchets</h1>
                <p class="fs-5">La comunauté de commune a pour adresse : 390 rue Henri Fabre 38926 Crolles<br> Téléphone : 04 76 08 04 57 <br>Les horaires d'ouvertures sont du lundi au vendredi de 8h45 à 12h et de 13h45 à 17h30.</p>
            </div>
        </div>

        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <h2>Chiffres financiers</h2>
                    <p>Cliquez ici pour suivre nos résultats</p>
                    <p><?= intval($recettes->montant)  ?>€ de recettes et <?= intval($depenses->montant) ?>€ de depenses en 2018</p>
                    <a href="resultats.php" class="btn btn-outline-light">Résultats</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Volume traité</h2>
                    <p>Consultez les chiffres de notre activité de ramassage des dechets</p>
                    <p><?= intval($tonnes->quantite)  ?> tonnes traitées en 2018</p>
                    <a href="chiffres.php" class="btn btn-outline-secondary">Nos chiffres</a>
                </div>
            </div>
        </div>

        <footer class="pt-3 mt-4 text-muted border-top">
            &copy; 2021
        </footer>
    </div>
</main>



</body>
</html>

