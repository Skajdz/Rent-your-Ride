<div id = "rides-holder">
    <div id = "rides-list">
        <h1>List of Rides</h2>
        <?php
            $rides = executeQuery("SELECT r.*,r.name as rName, p.src, p.name, p.main from ride r INNER JOIN ridepic rp ON r.idR=rp.idR INNER JOIN picture p ON rp.idS=p.idS WHERE main = 1");
        ?>

        <?php foreach($rides as $ride):?>
            <div class = "ride left">
                <div class = "img-ride">
                    <a href ="index.php?admin=Update_ride&ride=<?=$ride->idR?>"><img src = "<?=$ride->src?>" alt = "<?=$ride->rName?>"/></a>
                </div>
                <div class = "ride-name">
                    <p><a href = "index.php?admin=Update_ride&ride=<?=$ride->idR?>"><?=$ride->rName?></a></p>
                </div>
            </div>
        <?php endforeach;?> 
        
        
        <div class = "cleaner"></div>
    </div>
    <div id = "add-ride">
        <h1>Add a ride</h1>
        <div id = "inputs-add">
            <form action = "php/admin/insertRide.php" id = "addR" name = "addR" method = "POST" enctype = "multipart/form-data"> 
            <table>
                <tr>
                    <td><p>Name</p></td>
                    <td><p>Price</p></td>
                </tr>
                <tr>
                    <td><input type = "text" id = "ride-name" name = "ride-name" placeholder = "Name"/></td>
                    <td><input type = "text" id = "ride-price" name = "ride-price" placeholder = "Price"/></td>
                </tr>
                <tr>
                    <td><p>Bonus package</p></td>
                    <td><p>Bonus package price</p></td>
                </tr>
                <tr>
                    <td><input type = "text" id = "bp" name = "bp" placeholder = "Bonus package"/></td>
                    <td><input type = "text" id = "bpPrice" name = "bpPrice" placeholder = "Bonus package price"/></td>
                </tr>
                <tr>
                    <td colspan = "2"><p>Main picture</p></td>
                </tr>
                <tr>
                    <td colspan = "2"><input type = "file" size = "100" id = "main" name = "main"/></td>
                </tr>
                <tr>
                    <td colspan = "2"><p>Pictures</p></td>
                </tr>
                <tr>
                    <td colspan = "2"><input type = "file" id = "pictures" name = "pictures[]" multiple/></td>
                </tr>
                <tr>
                    <td colspan = "2"><p>Percent</p></td>
                </tr>
                <tr>
                    <td colspan = "2"><input type = "text" id = "percent" name = "percent" placeholder = "Percent"/></td>
                </tr>
                <tr>
                    <td colspan = "2"><p>Description</p></td>
                </tr>
                <tr>
                    <td colspan = "2"><textarea id = "textA" name = "textA" cols="36" rows ="10" form = "addR"></textarea></td>
                </tr>
                <tr>
                    <td colspan = "2"><input type = "submit" id = "submitR" name = "submitR" value = "Submit"/></td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>