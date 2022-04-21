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
$idVisite = 0;
$message = "";
$jauge = 10;
$nbNisitesEnCours = count(getVisitesEnCours());
if (isset($_POST["nbAdultes"]) && isset($_POST["nbEnfants"])) {
    $nbAdultes = $_POST["nbAdultes"];
    $nbEnfants = $_POST["nbEnfants"];
    $lastExpoId = getLastExpoId();

    for ($i = $lastExpoId; $i>0; $i--)
    {
        if (isset($_POST['expo'.$i]))
        {
            $checkedExpos[]=strval($i);
            $tarifAdulte = getTarifAdulte($i);
            $tarifEnfant = getTarifEnfant($i);
            $tarif += $tarifAdulte * $nbAdultes + $tarifEnfant * $nbEnfants;
        }
    }
    if (isset($_POST["valider"]))
    {
        if (($nbAdultes != 0 || $nbEnfants != 0) && isset($checkedExpos[0]))
        {
            if ($nbNisitesEnCours < $jauge)
            {
                $idVisite = addVisite($nbAdultes, $nbEnfants, $checkedExpos);
            }
            else
            {
                $message = "Jauge maximale attteinte - visite non créée";
            }
        }
        else
        {
            $message = "Vous devez ajouter au moins un adulte ou enfant et cocher au moins une exposition";
        }
    }
}
else
{
    $nbAdultes = 0;
    $nbEnfants = 0;
}

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage
$expos = getExposActive();

// traitement si necessaire des donnees recuperees
;

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Nouvelle visite";
include "$racine/vue/entete.html.php";
if (isset($_POST["valider"]) && $message == "")
{
    include "$racine/vue/vueConfirmVisite.php";
}
else
{
    include "$racine/vue/vueCreateVisite.php";
}
include "$racine/vue/pied.html.php";


?>