<?php 
header("Content-type: application/json");
$code = 403;
$data = "No data was sent";
session_start();

if(isset($_POST["reg"])){
    $code = 202;
    $error = [];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName']; 
    $pass = $_POST['pass']; 
    $phoneN = $_POST['phoneN']; 
    $driverL = $_POST['driverL']; 
    $email = $_POST['email'];

    $rFirstName = "/^[A-Z][a-z]{2,13}$/";
    $rLastName = "/^[A-Z][a-z]{2,13}$/";
    $rPhone = "/^(0|\+381)6[0-9][0-9]{6,8}$/";
    $rDriverL = "/^000[0-9]{6}$/";

    if(!preg_match($rFirstName, $firstName)){
        $error[] = "First name is not valid.";
        $code = 400;
    } 
    if(!preg_match($rLastName, $lastName)){
        $error[] = "Last name is not valid.";
        $code = 400;
    } 
    if(!preg_match($rPhone, $phoneN)){
        $error[] = "Your phone number is not valid.";
        $code = 400;
    } 
    if(!preg_match($rDriverL, $driverL)){
        $error[] = "Your driver's licence is not valid.";
        $code = 400;
    } 
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error[] = "Email is not valid.";
        $code = 400;
    }
    if(!preg_match("/^[\S]{6,}$/", $pass)){
        $error[] = "Your password is not long enough";
        $code = 400;
    }

    if(count($error) == 0){
        $code=202;
        require_once "functions.php";
        if(checkMail($email)):
            $_SESSION['info']="This email is already registerd.";
            $_SESSION['color']="red";
            $code = 400;
            $data="User already registed";
        elseif(checkLicence($driverL)):
            $_SESSION['info']="This driver's licence is already registerd.";
            $_SESSION['color']="red";
            $code = 400;
            $data="Driver's licence already registed";
        else:
        require_once "konekcija.php";
        $query = "INSERT INTO user (firstName, lastName, email, pass, licence, phone, idU) VALUES (:firstName, :lastName, :email, :pass, :licence, :phone, 2)";
        $stmt = $konekcija->prepare($query);
        $stmt -> bindParam(":firstName", $firstName);
        $stmt -> bindParam(":lastName", $lastName);
        $stmt -> bindParam(":email", $email);
        $stmt -> bindParam(":pass", md5($pass));
        $stmt -> bindParam(":licence", $driverL);
        $stmt -> bindParam(":phone", $phoneN);
        try{
            if($stmt -> execute()){
                $code = 201;
                $data = "Insert succesfull";
                $query = "SELECT * from user u INNER JOIN role r ON u.idU=r.idU WHERE email=:email AND pass=:pass";
                $stmt = $konekcija->prepare($query);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":pass", md5($pass));
                try{
                    $stmt->execute();
                    $user = $stmt->fetch();
                    if($user){
                        $_SESSION['user'] = $user;   
                        $data="Sesija je startovana";    
                        $code = 200;    
                    }
                    else{
                        $code = 400;
                    }
                }catch(PDOException $e){
                   
                    $code = 500;
                }
            }
        }catch(PDOException $e){
            $code = 500;
        }
    endif;
    }else{
        $code = 400;
    }   
}

    
echo json_encode($data);
http_response_code($code);