<?php
$serverBaze="localhost";
$username="root";
$pass="";
$bazaPodataka="rr";
 try{
     $konekcija=new PDO("mysql:host=$serverBaze;dbname=$bazaPodataka;charset=utf8",$username,$pass);
     $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
     
 }
 catch(PDOException $e)
    {
    echo "Greska sa konekcijom: " . $e->getMessage();
    }
?>