<?php 
header("Content-type: application/json");
$code = 403;
$data = "No data was sent";
session_start();

if(isset($_POST["data"])){
    $error = [];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName']; 
    $idK = $_POST['idK']; 
    $phoneN = $_POST['phoneN']; 
    $email = $_POST['email']; 
    $newP = $_POST['newP'];
    
    $rFirstName = "/^[A-Z][a-z]{2,13}$/";
    $rLastName = "/^[A-Z][a-z]{2,13}$/";
    $rPN = "/^(0|\+381)6[0-9][0-9]{6,8}$/";

    if(!preg_match($rFirstName, $firstName)){
        $error[] = "First name is not valid";
        $code = 404;
    }
    if(!preg_match($rLastName, $lastName)){
        $error[] = "Last name is not valid";
        $code = 404;
    }
    if(!preg_match($rPN, $phoneN)){
        $error[] = "Phone number  is not valid";
        $code = 404;
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error[] = "Email  is not valid";
        $code = 404;
    }
    if(count($error) == 0){
        require_once "konekcija.php";
        $newP = $_POST['newP'];
        
        if($newP == ""){
            $query = "UPDATE user SET firstName = :firstName, email = :email, lastName = :lastName, phone = :phone  WHERE idK = :idK";
            $stmt = $konekcija -> prepare($query);
            $stmt ->bindParam(":firstName", $firstName);
            $stmt ->bindParam(":email", $email);
            $stmt ->bindParam(":lastName", $lastName);
            $stmt ->bindParam(":phone", $phoneN);
            $stmt ->bindParam(":idK", $idK);
        }
        else{
            $data = "Usao sam u upit";
            $query = "UPDATE user SET firstName = :firstName, lastName = :lastName, email = :email, pass = :pass,  phone = :phone WHERE idK = :idK";
            $stmt = $konekcija -> prepare($query);
            $stmt ->bindParam(":firstName", $firstName);
            $stmt ->bindParam(":email", $email);
            $stmt ->bindParam(":lastName", $lastName);
            $stmt ->bindParam(":phone", $phoneN);
            $stmt ->bindParam(":idK", $idK);
            $stmt ->bindParam(":pass", md5($newP));
        }
        
        try{
            if($stmt -> execute()){
                $code = 200;
                $data = "User was successfuly updated";
                $_SESSION['user']->firstName = $firstName;
                $_SESSION['user']->lastName = $lastName;
                $_SESSION['user']->phone = $phoneN;
                $_SESSION['user']->email = $email;
            }
        }
        catch(PDOException $e){
            $code = 500;
        }
    }else{
        $code = 400;
    }   
}

    
echo json_encode($data);
http_response_code($code);