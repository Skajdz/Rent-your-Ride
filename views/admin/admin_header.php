<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panerl RR</title>
        <link href = "admin-style.css" rel = "stylesheet" type = "text/css">
    </head>
    <body>
        <?php 
            $rents = executeQuery("SELECT * FROM rented r INNER JOIN user u on r.idK = u.idK INNER JOIN ride rr ON r.idR = rr.idR");
            $pending = 0;
            foreach($rents as $r){
                if($r ->approved == "" && $r->expired == "")
                $pending++;
                
            }
        ?>
        <div id = "admin">
            <div id = "header">
                <h1><a href = "index.php">Rent your ride</a></h1>
            </div>
            <div id="menu" class = "left"> 
                <ul>
                    <li>
                        <a href = "index.php?admin=active">Active rents <?=($pending)? "- Pending <span class='white'>($pending)</span>":"" ?></a>
                    </li>
                    
                    <li>
                        <a href = "index.php?admin=users">List of Users</a>
                    </li>
                    <li>
                        <a href = "index.php?admin=rides">List of Rides</a>
                    </li>
                   
                    <li>
                        <a href = "index.php?admin=expired">Rent history</a>
                    </li>
                    <li>
                        <a href = "index.php?admin=activity">Activity</a>
                    </li>
                </ul>
            </div>
            <div id = "holder-content" class = "right">
                <div id = "content">
                    
