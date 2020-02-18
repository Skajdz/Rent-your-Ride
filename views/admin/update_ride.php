<div id = "update-ride-holder">
    <div id = "update-ride">
    <?php 
        if(!isset($_GET['ride'])||$_GET['ride'] == "" || !preg_match("/^[0-9]+$/", $_GET['ride']))
        header("Location:index.php?admin=rides");

        $rides = getRide($_GET['ride']);
        if(!$rides){
            header("Location: index.php?admin=rides");
        }
    ?>
        <h1><?=$rides[0]->rName?></h1>
        <div id = "rideDetails">
            <div id = "main-pic">
                <?php foreach($rides as $r): if($r->main == 1):?>
                <img src = "<?=$r->src?>" alt = "<?=$r->rName?>"/>
                <?php endif; endforeach?>
            </div>
            <div id = "pictures-holder">
                <?php foreach($rides as $r): if($r->main ==""):?>
                <div class = "rideU left">
                    <div class = "ride-pictureU">
                        <img src = "<?=$r->src?>" alt = "<?=$r->rName?>" />
                    </div>
                    <div class = "delete_link">
                        <a href = "#" class = "deleteP" data-id = "<?=$r->idS?>">Delete</a>
                    </div>
                </div>
                <?php endif; endforeach;?>
                
                <div class = "cleaner"></div>
                
            </div>
            <div id = "ride-update-inputs">
                <h1> Update <?=$rides[0]->rName?></h1>
                <form id = "updateR" action = "php/admin/updateRide.php" method = "POST" enctype = "multipart/form-data">
                <table>
                    <tr>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Bonus package</td>
                    </tr>
                    <tr>
                        <td><input type = "text" id = "nameU" name = "nameU" value = "<?=$rides[0]->rName?>" placeholder = "Name"/></td>
                        <td><input type = "text" id = "priceU" name = "priceU" value = "<?=$rides[0]->price?>" placeholder = "Price"/></td>
                        <td><input type = "text" id = "bpU" name = "bpU" value = "<?=$rides[0]->bonusP?>" placeholder = "Bonus package"/></td>
                    </tr>
                    <tr>
                        <td>Bonus package price</td>
                        <td>Percent</td>
                        <td>Discount</td>
                    </tr>
                    <tr>
                        <td><input type = "text" id = "bpPU" name = "bpPU" value = "<?=$rides[0]->bpPrice?>" placeholder = "Bonus package price"/></td>
                        <td><input type = "text" id = "percentU" name = "percentU" value = "<?=$rides[0]->percent?>" placeholder = "Percent (values from 5 to 8)"/></td>
                        <td><input type = "text" id = "dicountU" name = "dicountU" value = "<?=($rides[0]->discount)? $rides[0]->discount:""?>" placeholder = "Discount"/></td>
                    </tr>
                    <tr>
                        <td colspan = "3">Main picture</td>
                    </tr>
                    <tr>
                        <td colspan = "3"><input type = "file" name = "mainU" id = "mainU"/></td>
                    </tr>
                    <tr>
                        <td colspan = "3">Pictures</td>
                    </tr>
                    <tr>
                        <td colspan = "3"><input type = "file" name = "picturesU[]" id = "picturesU" multiple/></td>
                    </tr>
                    <tr>
                        <td colspan = "3">Description</td>
                    </tr>
                    <tr>
                        <td colspan = "3"><textarea form = "updateR" id = "textU" cols="36" rows ="10" name = "textU"><?=$rides[0]->description?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan = "3"><input type = "submit" value = "Update" id = "updateRR" name = "updateRR"/></td>
                    </tr>
                </table>
                <input type="text" name = "idRU" id = "idRU" value = "<?=$rides[0]->idR?>" hidden/>
            </form>
            </div>
        </div>
    </div>
</div>