<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$fichier="crolledepense.txt";
$fp=fopen($fichier,"r");

include 'include/pdo.php';
$db = new Connexion();

$c = 0;

while($tab=fgetcsv($fp,1000))
{
    $city = "Saint-martin-d uriage";
    printf("<br>%s", $city);
    $id = $db->qone("SELECT id_commune FROM COMMUNAUTE_DE_COMMUNES WHERE nom = '". $city ."'");
    printf(" %s", $id->id_commune);
    if(!empty($id->id_commune)){
        $sql = "insert into A_RAPORTE set id_commune='" . $id->id_commune . "', id_recette='1', montant='" . $tab[1] . "', année='" . $tab[4] . "'"; // on met la requète dans une variable
        printf("<br>%s<br>", $sql);
        //$db->execute($sql);
        $sql = "insert into A_RAPORTE set id_commune='" . $id->id_commune . "', id_recette='2', montant='" . $tab[3] . "', année='" . $tab[4] . "'"; // on met la requète dans une variable
        printf("<br>%s<br>", $sql);
        //$db->execute($sql);
    }
}

printf("<hr>");
printf("<table>");

try {
    $sql = "SELECT * FROM COMMUNAUTE_DE_COMMUNES";
    $resultat=$db->q($sql);

    foreach($resultat as $row) {
        printf("<tr>");
        printf("<td>%s</td>",$row->nom);
        printf("</tr>");

    }
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
printf("</table>");

printf("<hr>");




