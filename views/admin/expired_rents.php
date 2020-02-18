<div id = "table-active-rents">
    <div id = "expired">
        <h1>Expired rents</h1>
        <div class = "table-rentsP">
        <table>
            <?php foreach($rents as $r): if($r ->expired !=""):?>
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
                   
                </tr>
                <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            <?php endif; endforeach;?>
        </table>
        </div>
        
    </div>
    
</div>
