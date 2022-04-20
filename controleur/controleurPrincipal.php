<?php

function controleurPrincipal($action){
    $lesActions = array();
    $lesActions["defaut"] = "createVisite.php";
    $lesActions["create_visite"] = "createVisite.php";
    $lesActions["ongoing_visites"] = "ongoingVisites.php";
    $lesActions["param"] = "manageExpos.php";

    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["defaut"];
    }

}

?>