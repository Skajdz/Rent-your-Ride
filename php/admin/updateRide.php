<?php
session_start();
require_once "../functions.php";
if(isset($_POST['updateRR'])){
    $info = null;
    $idRU =$_POST['idRU'];
    $counter = [];
    $num = 0;
    if(isset($_POST['nameU']) && $_POST['nameU'] != ""){ 
        $name = $_POST['nameU'];
        $counter["name"] = $name;
        $num++;
    }

    if(isset($_POST['priceU']) && $_POST['priceU'] != ""){ 
        $price = $_POST['priceU'];
        $counter["price"] = $price;
        $num++;
    }

    if(isset($_POST['bpU']) && $_POST['bpU'] != ""){
         $bonusP = $_POST['bpU'];
         $counter["bonusP"] = $bonusP;
         $num++;
        }

    if(isset($_POST['bpPU']) && $_POST['bpPU'] != ""){
         $bonusPP = $_POST['bpPU'];
         $counter["bpPrice"] = $bonusPP;
         $num++;
        }

    if(isset($_POST['percentU']) && $_POST['percentU'] != ""){
         $percent = $_POST['percentU'];
         $counter["percent"] = $percent;
         $num++;
        }

    if(isset($_POST['textU']) &&$_POST['textU'] != ""){
         $description = $_POST['textU'];
         $counter["description"] = $description;
         $num++;
        }

    if(isset($_POST['dicountU']) && $_POST['dicountU'] != ""){ 
        $dicount = $_POST['dicountU'];
        $counter["discount"] = $dicount;
    }
    if(isset($_POST['dicountU'])){
    $num++;
    }
    if($num != 0){
        $total = count($counter);
        $number = 0;
        $string1 = "";
        $string2 = "";
        foreach($counter as $key => $value){
            $number++;
            if($number < $total){
                $string1 = $string1.$key."='".$value."', ";
            }
            else{
                $string1 = $string1.$key."='".$value."'";
            }
            
        }
        if($_POST['dicountU'] == ""){
            $string1 = $string1.", discount=:discount";
        }


        $query = "UPDATE ride SET $string1 WHERE idR = :idR";
        require_once "../konekcija.php";
        $stmt = $konekcija ->prepare($query);
        $stmt->bindParam(":idR", $_POST['idRU']);
        if($_POST['dicountU'] == "") $stmt->bindValue(':discount', null, PDO::PARAM_INT);
        try{
            $stmt->execute(); 
        }catch(PDOException $e){
           
        }
    }
    if(isset($_FILES['mainU']['name']) && $_FILES['mainU']['name'] != ""){
        $query = "SELECT p.*, rp.idR FROM picture p INNER JOIN ridepic rp ON p.idS=rp.idS WHERE idR=:idR AND main =1";
        $pic = $konekcija ->prepare($query);
        $pic ->bindParam(":idR", $idRU);
        try{
            $pic->execute();
            $idS = $pic->fetch();
            try{
                
                $image = $idS->src;
                $file= "../../".$image;
                unlink($file);
                $query = "DELETE FROM picture WHERE idS=$idS->idS";
                $stmt = $konekcija->prepare($query);
                try{
                    $stmt->execute();
                }catch(PDOExcpetcion $e){

                }
            } catch (Exception $e) {
        
            }
        }catch(PDOException $e){
            
        }
        $uploadedFileName = $_FILES['mainU']['name'];
        $upload_directory = "../../Slike/rides/";
        $targetPath=time().$uploadedFileName;

        if(move_uploaded_file($_FILES['mainU']['tmp_name'], $upload_directory.$targetPath)){
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
                    $stmt->bindParam(":idR", $idRU);

                    try{
                        $stmt->execute();
                    }catch(PDOException $e){
                    
                    }   
                }
             }catch(PDOException $e){
                
                }    
        }
        
    }
    $TotalUploadedFiles=count($_FILES['picturesU']['name']);
    if( $TotalUploadedFiles != 0){
        for($i=0;$i<$TotalUploadedFiles;$i++){
            $uploadedFileName=$_FILES['picturesU']['name'][$i];
            if($uploadedFileName!=''){
            $upload_directory = "../../Slike/rides/"; //Product Image Folder, Where you will upload Product Images
            $targetPath=time().$uploadedFileName;
                if(move_uploaded_file($_FILES['picturesU']['tmp_name'][$i], $upload_directory.$targetPath)){ 
                    $upl = "Slike/rides/";  
                    $srcHref = $upl.$targetPath;
                    $query = "INSERT INTO picture (name, src) VALUES(:name,:src)";
                    $stmt = $konekcija->prepare($query);  
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":src", $srcHref);
                    try{
                        if($stmt->execute()){
                            $pictureNo = $konekcija ->lastInsertId();
                            $query = "INSERT INTO ridepic (idS, idR) VALUES (:idS,:idR)";
                            $stmt = $konekcija ->prepare($query);
                            $stmt->bindParam(":idS", $pictureNo);
                            $stmt->bindParam(":idR", $idRU);
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
    }
    
    $usr = $_SESSION['user']->firstName;
    $dat = insertLog($usr,"Updated",$name,$info);
    header("Location: ../../index.php?admin=Update_ride&ride=".$idRU."");
}else header("Location: ../../index.php");