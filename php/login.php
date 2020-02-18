<?php
header("Content-type: application/json");
$code = 403;
$data = null;
session_start();
    
    if(isset($_POST["send"])){
        $code = 202;
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $rPass = "/^[\S]{6,}$/";
        $errors = [];

        if(!preg_match($rPass, $pass)){
            $errors[] = "Pogresno ste uneli email";
            $code = 400;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "Email nije ispravan";
            $code = 400;
        }
        if(count($errors)>0){
            $code=400;
            header("Location: ../index.php?page=home");
        }
        else{
            $passElse = $_POST["pass"];
            $code = 202;
            require_once "konekcija.php";
            $pass = md5($passElse);
            $query = "SELECT * from user u INNER JOIN role r ON u.idU=r.idU WHERE email=:email AND pass=:pass";
            $stmt = $konekcija->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pass", $pass);
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
                    require_once "functions.php";
                    if(checkMail($email)):
                    $_SESSION['info'] = "Wrong password.";
                    $_SESSION['color']="red";
                    else:
                    $_SESSION['info'] = "This email is not registerd";
                    $_SESSION["color"] = "red";
                    endif;
                    $data="Wrong login information submited.";
                }
            }catch(PDOException $e){
                $code = 500;
            }

        }
    }
    echo json_encode($data);
    http_response_code($code);