<?php
session_start();
require_once "../functions.php";
if(isset($_POST['submitR'])){
    $name = $_POST['ride-name'];
    $price = $_POST['ride-price'];
    $bonusP = $_POST['bp'];
    $bonusPP = $_POST['bpPrice'];
    $percent = $_POST['percent'];
    $description = $_POST['textA'];
    $query = "INSERT INTO ride (name, description, bonusP, bpPrice, price, percent) VALUES (:name, :description, :bonusP, :bpPrice, :price, :percent)";
    require_once "../konekcija.php";
    $stmt = $konekcija -> prepare($query);
    $stmt ->bindParam(":name", $name);
    $stmt ->bindParam(":description", $description);
    $stmt ->bindParam(":bonusP", $bonusP);
    $stmt ->bindParam(":bpPrice", $bonusPP);
    $stmt ->bindParam(":price", $price);
    $stmt ->bindParam(":percent", $percent);
    try{
        if($stmt -> execute()){
            echo "Podaci su  gotovo";
            $productNo = $konekcija ->lastInsertId();
            $TotalUploadedFiles=count($_FILES['pictures']['name']);
            for($i=0;$i<$TotalUploadedFiles;$i++){
                $uploadedFileName=$_FILES['pictures']['name'][$i];
                if($uploadedFileName!=''){
                $upload_directory = "../../Slike/rides/"; //Product Image Folder, Where you will upload Product Images
                $targetPath=time().$uploadedFileName;
                    if(move_uploaded_file($_FILES['pictures']['tmp_name'][$i], $upload_directory.$targetPath)){ 
                        $upl = "Slike/rides/";  
                        $srcHref = $upl.$targetPath;
                        $query = "INSERT INTO picture (name, src) VALUES(:name,:src)";
                        $stmt = $konekcija->prepare($query);  
                        $stmt->bindParam(":name", $name);
                        $stmt->bindParam(":src", $srcHref);
                        try{
                            if($stmt->execute()){
                                echo "Slike su dodate";
                                $pictureNo = $konekcija ->lastInsertId();
                                $query = "INSERT INTO ridepic (idS, idR) VALUES (:idS,:idR)";
                                $stmt = $konekcija ->prepare($query);
                                $stmt->bindParam(":idS", $pictureNo);
                                $stmt->bindParam(":idR", $productNo);
                                try{
                                    $stmt->execute();
                                }catch(PDOException $e){
                                }   
                            }
                        } catch(PDOException $e){
                        }              
                    }
                }
            }
            $uploadedFileName = $_FILES['main']['name'];
            if($uploadedFileName!=''){
                $upload_directory = "../../Slike/rides/";
                $targetPath=time().$uploadedFileName;
                if(move_uploaded_file($_FILES['main']['tmp_name'], $upload_directory.$targetPath)){
                    $upl = "Slike/rides/";  
                    $srcHref = $upl.$targetPath;
                    $query = "INSERT INTO picture (name, src,main) VALUES(:name,:src,1)";
                    $stmt = $konekcija->prepare($query);  
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":src", $srcHref);
                    try{
                        if($stmt->execute()){
                            $pictureNo = $konekcija ->lastInsertId();
                            $query = "INSERT INTO ridepic (idS, idR) VALUES (:idS,:idR)";
                            $stmt = $konekcija ->prepare($query);
                            $stmt->bindParam(":idS", $pictureNo);
                            $stmt->bindParam(":idR", $productNo);
                            try{
                                $stmt->execute();
                                $usr = $_SESSION['user']->firstName;
                                $dat = insertLog($usr,"Added",$name,"");
                                echo "Sve je gotovo";
                                //header("Location: ../../index.php?admin=rides");
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }   
                        }
                    } catch(PDOException $e){
                        echo $e->getMessage();

                    }    
                }
            }
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
}else header("Location: ../../index.php");