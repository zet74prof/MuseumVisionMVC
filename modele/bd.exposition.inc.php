<?php

include_once "bd.inc.php";

function getExpoById($id) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from exposition where id=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getExpos() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from exposition where active is true");
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

function getNextExpoId() {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select MAX(id)+1 as next_id from exposition");
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat['next_id'];
}

function getLastExpoId() {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select MAX(id) as last_id from exposition");
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat['last_id'];
}

function addExpo($nomExpo, $tarifAdulte, $tarifEnfant, $active) {
    $resultat = -1;
    try {
        $cnx = connexionPDO();
        $nextId = getNextExpoId();
        $req = $cnx->prepare("insert into exposition (id, nomExpo, tarifAdulte, tarifEnfant, active) values(:id, :nomExpo, :tarifAdulte, :tarifEnfant, :active)");
        $req->bindValue(':id', $nextId, PDO::PARAM_INT);
        $req->bindValue(':nomExpo', $nomExpo, PDO::PARAM_STR);
        $req->bindValue(':tarifAdulte', $tarifAdulte, PDO::PARAM_STR);
        $req->bindValue(':tarifEnfant', $tarifEnfant, PDO::PARAM_STR);
        $req->bindValue(':active', $active, PDO::PARAM_BOOL);

        $resultat = $req->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function updtExpo($id, $nomExpo, $tarifAdulte, $tarifEnfant, $active) {
    $resultat = -1;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("update exposition set nomExpo=:nomExpo, tarifAdulte=:tarifAdulte, tarifEnfant=:tarifEnfant, active=:active where id=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':nomExpo', $nomExpo, PDO::PARAM_STR);
        $req->bindValue(':tarifAdulte', $tarifAdulte, PDO::PARAM_STR);
        $req->bindValue(':tarifEnfant', $tarifEnfant, PDO::PARAM_STR);
        $req->bindValue(':active', $active, PDO::PARAM_BOOL);

        $resultat = $req->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getTarifAdulte($expoId) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select tarifAdulte from exposition where id=:id");
        $req->bindValue(':id', $expoId, PDO::PARAM_INT);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat['tarifAdulte'];
}

function getTarifEnfant($expoId) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select tarifEnfant from exposition where id=:id");
        $req->bindValue(':id', $expoId, PDO::PARAM_INT);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat['tarifEnfant'];
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "addExpo('expo test', 13.4, 3.5, true) : \n";
    print_r(addExpo('expo test', 13.4, 3.5, true));

    echo "getExpos() : \n";
    print_r(getExpos());

    echo "updtExpo(lastID,'expo test updated', 14.3, 4.6, false): \n";
    $lastId = getLastExpoId();
    print_r(updtExpo($lastId,'expo test updated', 14.3, 4.6, false));

    echo "getExpoById(id) : \n";
    print_r(getExpoById($lastId));

}
?>