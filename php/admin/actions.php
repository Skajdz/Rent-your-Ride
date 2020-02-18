<?php 
header("Content-type: application/json");
require_once "../functions.php";
session_start();
$code = 400;
$data = "Bad request";

if(isset($_POST['data']) && $_POST['data'] == "delete"){
    $idRe = $_POST['idRe'];
    $data = "$idRe";
    $query = "SELECT u.idK as idK FROM rented re INNER JOIN user u ON re.idK=u.idK WHERE idRe=:idRe";
    require_once "../konekcija.php";
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":idRe", $idRe);
    try{
        $stmt ->execute();
        $user = $stmt -> fetch();
        $code = 202;
    }catch(PDOException $e){
        $code = 500;
    }
    $data = $user -> idK;
    $query = "DELETE FROM rented WHERE idRe=:idRe";
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":idRe", $idRe);
    //Pre brisanja se pravi log
    $usr = $_SESSION['user']->firstName;
    $obj = findObj($idRe);
    $dat = insertLog($usr,"Deleted",$obj,"Rent request");

    try{
        if($stmt->execute()){
            $code = 200;
            $data = "Row has been deleted"; 
           
        }
    }catch(PDOException $e){
        $code = 500;
    }
    $user = $user -> idK;
    $query = "UPDATE user SET deleted = '1' WHERE idK=:idK";
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":idK", $user);
    try{
        if($stmt ->execute()){
            $code = 201;
            $data = "Updated delete on user";

        }
        
    }catch(PDOException $e){
       $code = 500;
    }
    
}
else if(isset($_POST['data']) && $_POST['data'] == "approve"){
    $idRe = $_POST['idRe'];
    $data = "$idRe";
    $code = 202;
    $query = "UPDATE rented SET approved = '1' WHERE idRe=:idRe";
    require_once "../konekcija.php";
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":idRe", $idRe);
    try{
        if($stmt -> execute()){
            $code = 201;
            $data = "Rent has been approved";
            $usr = $_SESSION['user']->firstName;
            $obj = findObj($idRe);
            $dat = insertLog($usr,"Approved",$obj,"Rent request");
        }
    }catch(PDOException $e){
        $code = 500;
    }
}
else if(isset($_POST['data']) && $_POST['data'] == "cancel"){
    $idRe = $_POST['idRe'];
    $data = "$idRe";
    $code = 202;
    $query = "UPDATE rented SET approved = NULL WHERE idRe=:idRe";
    require_once "../konekcija.php";
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":idRe", $idRe);
    try{
        if($stmt -> execute()){
            $code = 201;
            $data = "Rent has been canceled";
            $usr = $_SESSION['user']->firstName;
            $obj = findObj($idRe);
            $dat = insertLog($usr,"Canceled",$obj,"Rent request");
        }
    }catch(PDOException $e){
        $code = 500;
    }
}
else if(isset($_POST['data']) && $_POST['data'] == "insertAdmin"){
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $code = 202;
    $query = "INSERT INTO user (firstName, lastName, email, pass, idU, licence, phone) VALUES (:firstName,'Admin',:email, :pass, 1, 000000000, 061000000)";
    require_once "../konekcija.php";
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":firstName", $lastName);
    $stmt -> bindParam(":pass", md5($pass));
    $stmt -> bindParam(":email", $email);
    try{
        if($stmt -> execute()){
            $code = 201;
            $data = "Admin has been added";
        }
    }catch(PDOException $e){
        $code = 500;
    }
}
else if(isset($_POST['data']) && $_POST['data'] == "deleteP"){
    $idS = $_POST['idS'];
    $code = 202;
    $image = getPicture($idS);
    $file= "../../".$image->src;
    unlink($file);
    $query = "DELETE FROM picture WHERE idS=:idS";
    require_once "../konekcija.php";
    $stmt = $konekcija -> prepare($query);
    $stmt -> bindParam(":idS", $idS);
    //Updating the log before deleting the picture
    $usr = $_SESSION['user']->firstName;
    $dat = insertLog($usr,"Deleted",$image->name,"Picture");

    try{
        if($stmt -> execute()){
            $code = 201;
            $data = "Picture has been deleted";
        }
    }catch(PDOException $e){
        $code = 500;
    }
}
echo json_encode($data);
http_response_code($code);