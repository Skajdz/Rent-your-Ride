<?php 
session_start();
require_once "php/functions.php";
include "php/konekcija.php";
checkExpired();

if(isset($_GET["admin"]) && isset($_SESSION['user'])):
   
    if($_SESSION['user']->name == "Korisnik"):
        header("Location: index.php");
    else:
    
    $adminPanel=$_GET['admin'];
    include "views/admin/admin_header.php";
    switch($adminPanel){
        case "active":
            include "views/admin/active_rents.php";
        break;
        case "users":
            include "views/admin/users.php";
        break;
        case "expired":
            include "views/admin/expired_rents.php";
        break;
        case "rides":
            include "views/admin/rides.php";
        break;
        case "Update_ride":
            include "views/admin/update_ride.php";
        break;
        case "activity":
            include "views/admin/activity.php";
        break;
        default: 
            include "views/admin/active_rents.php";
        break;
    }
    include "views/admin/admin_footer.php";
    endif;
    
    
else:

include "views/head.php";
include "views/menu.php";
if(isset($_GET['page'])){
    $page=$_GET['page'];
    switch($page){
        case "home":
            include "views/home.php";
        break;
        case "catalog":
            include "views/rides_catalog.php";
        break;
        case "ride_details":
            include "views/ride-details.php";
        break;
        case "registration":
            include "views/reg.php";
        break;
        case "paperwork":
            include "views/paperwork.php";
        break;
        case "Terms":
            include "views/tos.php";
        break;
        case "user":
            include "views/user.php";
        break;
        case "about":
            include "views/about.php";
        break;
        default:
            include "views/home.php";
        break;
    }
}
else include "views/home.php";
include "views/footer.php";
endif;



