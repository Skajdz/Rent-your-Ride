<div id = "table-active-rents">
    <?php if($pending != 0):?>
    <div id="pending">
        <h1>Pending rents</h1>
        
        <div class = "table-rentsP">
        <table>
        <?php foreach($rents as $r): if($r ->approved =="" && $r->expired == ""):?>
            <tr>
                <td><span class = "data"><?=$r -> firstName?></span></td>
                <td><span class = "data"><?=$r -> lastName?></span></td>
                <td><span class = "data"><?=$r -> name?></span></td>
                <td>Phone: <span class = "data"><?=$r -> phone?></span></td>
                <td>Licence: <span class = "data"><?=$r -> licence?></span></td>
                <td>Pickup date: <span class = "data"><?=$r -> pDate?></span></td>
                <td>Return date: <span class = "data"><?=$r -> rDate?></span></td>
                <td>Pickup/Return: <span class = "data"><?=$r -> rPAdress?></span></td>
                <td>Bonus: <span class = "data"><?=($r -> bonusP)?"Yes":"No"?></span></td>
                <td>Total: <span class = "data"><?=$r -> totalPrice?>$</span></td>
                <td><input type = "checkbox" class = "ckA" value = "<?=$r -> idRe?>" name = "ckA<?=$r->idRe?>"/> Approve </td>
                <td><input type = "checkbox" class = "delete" value = "<?=$r -> idRe?>" name = "delete<?=$r->idRe?>"/> Delete </td>
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
        <?php endif; endforeach;?>
        </table>
        </div>
        
    </div>
    <?php endif;?>
    <div id = "active">
        <h1>Active rents</h1>
        <div class = "table-rentsA">
            <table>
                <?php foreach($rents as $r): if($r ->approved !="" && $r ->expired ==""):?>
                <tr>
                    <td><span class = "data"><?=$r -> firstName?></span></td>
                    <td><span class = "data"><?=$r -> lastName?></span></td>
                    <td><span class = "data"><?=$r -> name?></span></td>
                    <td>Phone: <span class = "data"><?=$r -> phone?></span></td>
                    <td>Licence: <span class = "data"><?=$r -> licence?></span></td>
                    <td>Pickup/Return: <span class = "data"><?=$r -> rPAdress?></span></td>
                    <td>Pickup date: <span class = "data"><?=$r -> pDate?></span></td>
                    <td>Return date: <span class = "data"><?=$r -> rDate?></span></td>
                    <td>Bonus: <span class = "data"><?=($r -> bonusP)?"Yes":"No"?></span></td>
                    <td>Total: <span class = "data"><?=$r -> totalPrice?>$</span></td>
                    <td><input type = "checkbox" class = "cancel" value = "<?=$r -> idRe?>" name = "cancel<?=$r -> idRe?>"/> Cancel </td>
                </tr>
                <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <?php endif; endforeach;?>
            </table>
        </div>
        
    </div>
</div>
