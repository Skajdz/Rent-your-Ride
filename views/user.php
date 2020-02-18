<?php if(isset($_SESSION['user'])):

    $rented = getRented($_SESSION['user'] -> idK);
    undoDelete($_SESSION['user']->idK);
?>
<div id="user">
    <div id = "user-header">
        <h1><?=$_SESSION['user']->firstName?> <?=$_SESSION['user']->lastName?></h1>
        <h2><a id="link-change" href = "#change-info">Change info</a></h2>
    </div>
    <?php foreach($rented as $r):?>
    <?php if($r->expired == "" ):?>

    <div class = "holder-rent">
        <h3>Active rent</h3>
        <?php foreach($rented as $r):?>
        <?php if($r->expired ==""):?>

        <h4>Approved: 
            <span class="white"><?=($r->approved)? "Yes":"No"?></span>
        </h4>

        <?php endif;?>
        <?php endforeach;?>
        <?php foreach($rented as $r):?>
        <?php if($r->expired ==""):?>

        <div class = "ride-show">
            <div class = "img-ride-user left">
                <img src = "<?=$r -> src?>" alt = "<?=$r -> name?>"/>
            </div>
            <div class = "ride-details-h ">
                <p><?=$r -> name?></p>
                
            </div>
            
            <div class = "rent-details-user ">
                
                <p>Pickup: <span class = "white"><?=$r -> pDate?></span> </p>
                <p>Return: <span class = "white"><?=$r -> rDate?></span> </p>
            </div>
            <div class = "rent-details-user ">
                <h5>Bonus package :  <span class = "white"><?=($r->bonusP)? "Yes":"No"?></span></h5>
                <h5>Total price: <span class = "white"><?=$r -> totalPrice?>$</span></h5>
                <p>Pickup/Return adress: <br/><span class = "white"><?=$r -> rPAdress?></span></p>   
            </div>
        </div>

        <?php endif;?>
        <?php endforeach;?>
    </div>

    <?php endif;?>
    <?php endforeach;?>

    <?php foreach($rented as $r):?>
    <?php if($r -> expired != ""):?>
    <div class = "past-rent">
        <h3>Renting history</h3>

        <?php foreach($rented as $r):?>
        <?php if($r -> expired != ""):?>

        <div class = "ride-show">
            <div class = "img-ride-user left">
                <img src = "<?=$r -> src?>" alt = "<?=$r -> name?>"/>
            </div>
            <div class = "ride-details-h ">
                <p><?=$r -> name?></p>
                
            </div>
            
            <div class = "rent-details-user ">
               
                <p>Rented: <span class = "white"><?= $r -> pDate?></span> </p>
                <p>Returned: <span class = "white"><?=$r -> rDate?></span> </p>
            </div>
            <div class = "rent-details-user ">
            <h5>Bonus package :  <span class = "white"><?=($r->bonusP)? "Yes":"No"?></span></h5>
            <h5>Total price: <span class = "white"><?=$r -> totalPrice?>$</span></h5>
            <p>Pickup/Return adress: <br/><span class = "white"><?=$r -> rPAdress?></span></p>   
            </div>
        </div>

        <?php endif;?>
        <?php endforeach;?>
        
    </div>
    <?php break;?>
    <?php endif;?>
    <?php endforeach;?>
    <div id="change-info">
        <h3>User info</h3>
        <form method="POST" action="#">
            <input type="text" id = "userIdHidden" name = "userIdHidden" value = "<?=$_SESSION['user'] -> idK?>" hidden/>
            <table>
                <tr>
                    <td><p>First name</p></td>
                    <td><p>Last name</p></td>
                </tr>
                <tr>
                    <td>
                        <input type = "text" placeholder = "First name" name = "firstNameU" id = "firstNameU" value="<?=$_SESSION['user']->firstName?>"/>
                    </td>
                    <td>
                        <input type = "text" placeholder = "Last name" name = "lastNameU" id = "lastNameU" value="<?=$_SESSION['user']->lastName?>"/>
                    </td>
                </tr>
                <tr>
                    <td><p>Email</p></td>
                    <td><p>Phone number</p></td>
                </tr>
                <tr>
                    <td>
                        <input type = "text" placeholder = "Email" name = "emailU" id = "emailU" value="<?=$_SESSION['user']->email?>"/>
                    </td>
                    <td>
                        <input type = "text" placeholder = "Phone number" name = "pNU" id = "pNU" value="<?=$_SESSION['user']->phone?>"/>
                    </td>
                </tr>
                <tr>
                    <td><p>New password</p></td>
                    <td><p>Confirm new password</p></td>
                </tr>
                <tr>
                    <td>
                        <input type = "password" placeholder = "New password" name = "passU" id = "passU" />
                    </td>
                    <td>
                        <input type = "password" placeholder = "Confirm new password" name = "cPassU" id = "cPassU"/>
                    </td>
                </tr>
                <tr>
                    <td colspan = "2">
                        <input type = "submit" value = "Change info" id = "cInfo" name = "cInfo"/>
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php else: header("Location: index.php?page=home"); endif;?>