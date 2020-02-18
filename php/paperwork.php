<?php
header("Content-type: application/json");
$code = 403;
$data = "No data was sent";
session_start();

if(isset($_POST["paperwork"])){
    $code = 202;
    $error = "";
    $adress = $_POST['adress'];
    $rAdress = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,20}([\s]?([A-ZŠĐČĆŽ]?[a-zšđčćž]{2,12})?)+[\s]?[0-9]+[A-ZŠĐČĆŽa-zšđčćž]?$/";
    $bpP = $_POST['bpP']; 
    $idR = $_POST['idR']; 
    $rDate = $_POST['rDate']; 
    $pDate = $_POST['pDate']; 
    $totalPrice = $_POST['totalPrice'];
    $idK = $_POST['idK'];

    if(!preg_match($rAdress, $adress)){
        $error = "This adress in not ok!";
        $code = 400;
    } 

    if($error == ""){
        $code = 402;
        require_once "konekcija.php";
        $query = "INSERT INTO `rented` (`idR`, `idK`, `pDate`, `rDate`, `rPAdress`, `bonusP`, `totalPrice`) VALUES (:idR, :idK, :pDate, :rDate, :adress, :bonusP, :totalPrice)";
        $stmt = $konekcija->prepare($query);
        $stmt -> bindParam(":idR", $idR);
        $stmt -> bindParam(":idK", $idK);
        $stmt -> bindParam(":pDate", $pDate);
        $stmt -> bindParam(":rDate", $rDate);
        $stmt -> bindParam(":adress", $adress);
        $stmt -> bindParam(":bonusP", $bpP);
        $stmt -> bindParam(":totalPrice", $totalPrice);
        try{
            if($stmt -> execute()){
                $code = 201;
                $data = "Insert succesfull";
            }
        }catch(PDOException $e){
            $code = 500;
        }
    }else{
        $code = 400;
        $data = "There's a mistake in the data sent";
    }   
}

    
echo json_encode($data);
http_response_code($code);