<?php

include_once "bd.inc.php";

function getVisiteById($id) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from visite where id=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getVisites() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from visite");
        $req->execute();

        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            $resultat[] = $ligne;
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getVisitesEnCours() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from visite where dateHeureDepart is NULL");
        $req->execute();

        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            $resultat[] = $ligne;
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getNextVisiteId() {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select MAX(id)+1 as next_id from visite");
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat['next_id'];
}

function getLastVisiteId() {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select MAX(id) as last_id from visite");
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat['last_id'];
}

function getTarifVisite($nbAdultes, $nbEnfants, $expos) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from visite where id=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function addVisite($nbVisAd, $nbVisEnf, $expos) {
    $nextId = 0;
    try {
        $cnx = connexionPDO();
        $nextId = getNextVisiteId();
        $req = $cnx->prepare("insert into visite (id, nbVisiteursAdultes, nbVisiteursEnfants, dateHeureArrivee) values(:id, :nbVisiteursAdultes, :nbVisiteursEnfants, NOW())");
        $req->bindValue(':id', $nextId, PDO::PARAM_INT);
        $req->bindValue(':nbVisiteursAdultes', $nbVisAd, PDO::PARAM_INT);
        $req->bindValue(':nbVisiteursEnfants', $nbVisEnf, PDO::PARAM_INT);

        $resultat1 = $req->execute();

        foreach ($expos as $expo)
        {
            $req = $cnx->prepare("insert into visite_exposition (idVisite, idExpo) values(:idVisite, :idExpo)");
            $req->bindValue(':idVisite', $nextId, PDO::PARAM_INT);
            $req->bindValue(':idExpo', $expo, PDO::PARAM_INT);

            $resultat2 = $req->execute();
        }

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $nextId;
}

function updtFinVisite($idVisite, $dateHeureFin) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("update visite set dateHeureDepart=:dateHeureDepart where id=:id");
        $req->bindValue(':id', $idVisite, PDO::PARAM_INT);
        $req->bindValue(':dateHeureDepart', $dateHeureFin, PDO::PARAM_STR);

        $resultat = $req->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "addVisite(nbAdult,nbEnfant,expos) : \n";
    $expos = array(1,2);
    print_r(addVisite(1,1,$expos));

    echo "getVisiteById(id) : \n";
    print_r(getVisiteById(1));

    echo "getVisites() : \n";
    print_r(getVisites());

    echo "getVisitesEnCours() : \n";
    print_r(getVisitesEnCours());

}
?>