<?php
require_once('include/jpgraph/src/jpgraph.php');
require_once('include/jpgraph/src/jpgraph_line.php');
require_once ('include/pdo.php');
$db = new Connexion();
if(isset($_GET['id']) && isset($_GET['type'])){
    $id = intval($_GET['id']);
    $nom = $db->qone("SELECT nom FROM COMMUNAUTE_DE_COMMUNES WHERE id_commune = :id", array(array('id', $id, PDO::PARAM_STR)));
    if($_GET['type'] == 'chiffre'){
        $data = $db->q("SELECT id_commune, année, SUM(quantite) AS quantite FROM QUANTITE_PRODUITE WHERE id_commune = :id GROUP BY id_commune, année", array(array('id', $id, PDO::PARAM_STR)));
        $xdata = [];
        $ydata = [];
        foreach($data as $d){
            array_push($xdata, $d->année);
            array_push($ydata, $d->quantite);
        }
        // Size of the overall graph
        $width=500;
        $height=400;

        // Create the graph and set a scale.
        // These two calls are always required
        $graph = new Graph($width,$height);
        $graph->SetScale('intlin');

        // Create the linear plot
        $lineplot=new LinePlot($ydata);

        // Add the plot to the graph
        $graph->Add($lineplot);

        $graph->xaxis->SetTickLabels($xdata);

        $graph->title->Set("Production de déchets en tonnes de ". $nom->nom);
        $graph->title->SetFont(FF_DV_SANSSERIF,FS_BOLD,10);

        // Display the graph
        $graph->Stroke();
    } elseif($_GET['type'] == "recettes"){
        $data = $db->q("SELECT id_commune, année, SUM(montant) AS montant FROM A_RAPORTE WHERE id_commune = :id GROUP BY id_commune, année", array(array('id', $id, PDO::PARAM_STR)));
        $xdata = [];
        $ydata = [];
        foreach($data as $d){
            array_push($xdata, $d->année);
            array_push($ydata, $d->montant);
        }
        // Size of the overall graph
        $width=550;
        $height=400;

        // Create the graph and set a scale.
        // These two calls are always required
        $graph = new Graph($width,$height);
        $graph->SetScale('intlin');

        // Create the linear plot
        $lineplot=new LinePlot($ydata);

        // Add the plot to the graph
        $graph->Add($lineplot);

        $graph->xaxis->SetTickLabels($xdata);

        $graph->title->Set("Recettes de ". $nom->nom);
        $graph->title->SetFont(FF_DV_SANSSERIF,FS_BOLD,10);

        // Display the graph
        $graph->Stroke();
    } elseif($_GET['type'] == "depenses"){
        $data = $db->q("SELECT id_commune, année, SUM(montant) AS montant FROM A_DEPENSE WHERE id_commune = :id GROUP BY id_commune, année", array(array('id', $id, PDO::PARAM_STR)));
        $xdata = [];
        $ydata = [];
        foreach($data as $d){
            array_push($xdata, $d->année);
            array_push($ydata, $d->montant);
        }
        // Size of the overall graph
        $width=550;
        $height=400;

        // Create the graph and set a scale.
        // These two calls are always required
        $graph = new Graph($width,$height);
        $graph->SetScale('intlin');

        // Create the linear plot
        $lineplot=new LinePlot($ydata);

        // Add the plot to the graph
        $graph->Add($lineplot);

        $graph->xaxis->SetTickLabels($xdata);

        $graph->title->Set("Depenses de ". $nom->nom);
        $graph->title->SetFont(FF_DV_SANSSERIF,FS_BOLD,10);

        // Display the graph
        $graph->Stroke();
    }
}
