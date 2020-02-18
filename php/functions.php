<?php
require_once "konekcija.php";

//Izvrsavanje generalnog Selecta
function executeQuery($query){
    global $konekcija;
    $stmt = $konekcija->prepare($query);
    try{
        $stmt -> execute();
        return $stmt->fetchAll();
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function getRide($rideID){
    global $konekcija;
    $query = "SELECT r.*,r.name AS rName, p.name AS pName,p.idS , p.src, p.main FROM ride r INNER JOIN ridepic rp ON r.idR=rp.idR INNER JOIN picture p ON rp.idS=p.idS WHERE r.idR=:idR";
    $stmt = $konekcija->prepare($query);
    $stmt -> bindParam(":idR", $rideID);
    try{
        $stmt -> execute();
        return $stmt -> fetchAll();
    } 
    catch(PDOException $e){
        echo $e -> getMessage();
    }
}

function getRented($idK){
    $query = "SELECT r.*,r.idK AS idK,p.name,p.src FROM `rented` r INNER JOIN ridepic rp ON r.idR=rp.idR INNER JOIN picture p ON rp.idS=p.idS WHERE main=1 AND idK = :idK";
    global $konekcija;
    $stmt = $konekcija ->prepare($query);
    $stmt -> bindParam(":idK", $idK);
    try{
        $stmt -> execute();
        return $stmt -> fetchAll();
    } 
    catch(PDOException $e){
        echo $e -> getMessage();
    }
}

function checkMail($email){
    $query = "SELECT * FROM user WHERE email=:email";
    global $konekcija;
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":email", $email);
    try{
        $stmt -> execute();
        return $stmt -> fetch();
    }catch(PDOException $e){

    }
}
function undoDelete($idK){
    global $konekcija;

    $query = "SELECT * FROM user WHERE idK=:idK";
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":idK", $idK);
    try{
        $stmt -> execute();
        $deleted = $stmt->fetch()->deleted;
    }catch(PDOException $e){

    }

    if($deleted == 1):
    $query = "UPDATE user SET deleted = NULL WHERE idK = :idK";
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":idK", $idK);
    try{
        $stmt -> execute();
        $_SESSION['info'] = "Your rent application was denied";
        $_SESSION['color'] = "red";
        header("Location: index.php?page=user");
    }catch(PDOException $e){

    }
    endif;
}

function checkLicence($licence){
    $query = "SELECT * FROM user WHERE licence=:licence";
    global $konekcija;
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":licence", $licence);
    try{
        $stmt -> execute();
        return $stmt -> fetch();
    }catch(PDOException $e){

    }
}

function getPicture($idS){
    $query = "SELECT * from picture WHERE idS=:idS";
    global $konekcija;
    $stmt = $konekcija ->prepare($query);
    $stmt -> bindParam(":idS", $idS);
    try{
        $stmt -> execute();
        return $stmt -> fetch();
    } 
    catch(PDOException $e){
        echo $e -> getMessage();
    }
}

function ifActiveRent($idK){
    $query = "SELECT * FROM rented r INNER JOIN user u ON r.idK=u.idK WHERE r.idK=:idK AND expired IS NULL
    ";
    global $konekcija;
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":idK",$idK);
    try{
        $stmt -> execute();
        return $stmt -> fetch();
    }catch(PDOException $e){

    }
}
function insertLog($subject, $action, $obj, $info){
    $query = "INSERT INTO `activity` (`who`, `act`, `obj`, `info`) VALUES (:data, :action, :obj, :info);
    ";
    global $konekcija;
    $stmt = $konekcija -> prepare($query);
    $stmt ->bindParam(":data", $subject);
    $stmt ->bindParam(":action", $action);
    $stmt ->bindParam(":obj", $obj);
    $stmt ->bindParam(":info", $info);
    try{
        if($stmt ->execute());
        return 200;
    }catch(PDOException $e){

    }
}
function findObj($idRe){
    $query = "SELECT * FROM rented r LEFT JOIN user u ON r.idK=u.idK WHERE r.idRe=:idRe";
    global $konekcija;
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":idRe",$idRe);
    try{
        $stmt -> execute();
        
        $email = $stmt -> fetch()->email;
        return $email;
    }catch(PDOException $e){

    }
}
function checkExpired(){
    $rentedRow = executeQuery("SELECT * FROM rented WHERE expired IS NULL");
    foreach($rentedRow as $row):
    $date = explode(" ", $row->rDate);
    $dates = explode("-", $date[0]);
    $time = explode(":", $date[1]);
    $expireTime = mktime($time[0], $time[1], $time[2], $dates[1], $dates[2], $dates[0]);
    if(intval($expireTime) < time()){
        $query = "UPDATE rented SET expired = 1 WHERE idRe = :idRe";
        global $konekcija;
        $stmt = $konekcija ->prepare($query);
        $stmt -> bindParam(":idRe", $row->idRe);
        try{
            $stmt -> execute();
        }catch(PDOException $e){

        }
    }
    endforeach;
    //	2020-02-21 02:02:00

    //hour, minute, second, month, day, year
}



