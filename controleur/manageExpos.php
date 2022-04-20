<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/bd.exposition.inc.php";

// recuperation des donnees GET, POST, et SESSION
$hidden = true;
$active = false;
$displayAlert = false;
$message = "";
$action = 0; //0 = affichage, 1 = création, 2 = modification, 3 = enregistrement
if (isset($_GET['actionExpo']))
{
    if ($_GET['actionExpo'] == 'create')
    {
        $action = 1;
    }
    elseif ($_GET['actionExpo'] == 'modif')
    {
        $action = 2;
    }
    $hidden = false;
}
//test si la coche "active" du formulaire est cochée
if (isset($_POST['active']) && $_POST['active'] == 'on')
{
    $active = true;
}

if (isset($_POST['expoId']))
{
    if (!empty($_POST['expoId']) && !empty($_POST['expoName']) && !empty($_POST['tarifAdulte']) && !empty($_POST['tarifEnfant']))
    {
        updtExpo($_POST['expoId'],$_POST['expoName'],$_POST['tarifAdulte'],$_POST['tarifEnfant'],$active);
    }
    elseif (empty($_POST['expoId']) && !empty($_POST['expoName']) && !empty($_POST['tarifAdulte']) && !empty($_POST['tarifEnfant']))
    {
        addExpo($_POST['expoName'],$_POST['tarifAdulte'],$_POST['tarifEnfant'],$active);
    }
    else
    {
        $displayAlert = true;
        $message = "Il manque des données pour l'expo";
    }
    $hidden = true;
}

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage
$expos = getExpos();
if ($action == 2)
{
    $expoSelected = getExpoById($_GET['expoId']);
}

// traitement si necessaire des donnees recuperees


// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Gestion des expositions";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueManageExpos.php";
include "$racine/vue/pied.html.php";

?>