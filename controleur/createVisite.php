<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/bd.exposition.inc.php";
include_once "$racine/modele/bd.visite.inc.php";

// recuperation des donnees GET, POST, et SESSION
;
$checkedExpos = Array();
$tarif = 0;
if (isset($_POST["nbAdultes"]) && isset($_POST["nbEnfants"])) {
    $nbAdultes = $_POST["nbAdultes"];
    $nbEnfants = $_POST["nbEnfants"];
    $lastExpoId = getLastExpoId();

    for ($i = $lastExpoId; $i>0; $i--)
    {
        if (isset($_POST['expo'.$i]))
        {
            $checkedExpos[]=$i;
            $tarifAdulte = getTarifAdulte($i);
            $tarifEnfant = getTarifEnfant($i);
            $tarif += $tarifAdulte * $nbAdultes + $tarifEnfant * $nbEnfants;
        }
    }
}
else
{
    $nbAdultes = 0;
    $nbEnfants = 0;
}

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage
$expos = getExpos();

// traitement si necessaire des donnees recuperees
;

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Nouvelle visite";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueCreateVisite.php";
include "$racine/vue/pied.html.php";


?>