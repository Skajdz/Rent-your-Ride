<?php 
//If koji proverava da li su poslati parametri za prikaz odredjenog vozila, da li je id setovan i da li je broj...
if(isset($_GET['page']) && isset($_GET['ride']) && $_GET['ride'] != '' && preg_match("/^[0-9]+$/", $_GET['ride'])):
    $ride = getRide($_GET['ride']);
    if($ride):
?>
<div id="content-ride">
    <div id="ride-banner">
        <div id="ride-img" class="left">
            <img src="<?=$ride[0]->src?>" alt="<?=$ride[0]->pName?>"/>
        </div>
        <div id="ride-name" class="left">
            <h1><?=$ride[0]->pName?></h1>
            <p class="justify"><?=$ride[0]->description?></p>
            <h2>Bonus package:</h2>
            <p><?=$ride[0]->bonusP?> (<?=$ride[0]->bpPrice?>$)</p>
            <div id="paperwork-d">

            <?php if(isset($_SESSION['user'])):if(!ifActiveRent($_SESSION['user'] -> idK)):?>
                <a href="index.php?page=paperwork&ride=<?=$ride[0]->idR?>">Paperwork</a>
            <?php else:?>
                <h3>You already have an <a href="index.php?page=user">Active/Pending</a> rent</h3>
            <?php endif;?>
            <?php else:?>
                <h3>If you wish to rent this ride please <a href="index.php?page=registration">register</a>.
            <?php endif;?>
            </div>
        </div>
        <div id="ride-prices">
            <table>
                <tr>
                    <td>
                        <p> Days</p>
                    </td>
                    <td>
                        <p>Price per day</p>
                    </td>
                    </tr>
                    <!--Ako vozilo nema popust tabela ce imati normalan prikaz -->
                    <?php if($ride[0]->discount == null):?>
                                
                    <tr>
                        <td>1</td>
                        <td><?=$ride[0]->price?>$</td>
                            
                    </tr>
                    <tr>
                        <td>2-5</td>
                        <?php $percent = ($ride[0] -> price * $ride[0] -> percent)/100 ?>
                        <!-- Oduzima se procenat(6-8%) od ukupne cene-->
                        <td><?=$calculated=$ride[0]->price - round($percent)?>$</td>
                    </tr>
                    <tr>
                        <td>6-10</td>
                        <td><?=$calculated=$ride[0]->price - round($percent*2)?>$</td>
                    </tr>
                    <tr>
                        <td>11-20</td>
                        <td><?=$calculated=$ride[0]->price - round($percent*3)?>$</td>
                    </tr>
                    <tr>
                        <td>20+</td>
                        <td><?=$calculated=$ride[0]->price - round($percent*4)?>$</td>
                    </tr>
                    <?php else:?>
                    <!-- Ako postoji popust, prvoj ceni se dodaje klasa "old" i pored nje se ispisuje nova cena.-->
                    <tr>
                        <td>1</td>
                        <td><span class="old"><?=$ride[0]->price?>$</span> <?=$ride[0]->discount?>$</td>
                    </tr>
                    <tr>
                        <td>2-5</td>
                        <td><span class="old"><?=$calculated=$ride[0]->price - round(($ride[0]->price * $ride[0]->percent)/100)?>$</span> <?=$calculatedDiscount=$ride[0]->discount - round(($ride[0]->discount * $ride[0]->percent)/100)?>$</td>
                    </tr>
                    <tr>
                        <td>6-10</td>
                        <td><span class="old"><?=$calculated=$calculated - round(($calculated * $ride[0]->percent)/100)?>$</span> <?=$calculatedDiscount=$calculatedDiscount - round(($calculatedDiscount * $ride[0]->percent)/100)?>$</td>
                    </tr>
                    <tr>
                        <td>11-20</td>
                        <td><span class="old"><?=$calculated=$calculated - round(($calculated * $ride[0]->percent)/100)?>$</span> <?=$calculatedDiscount=$calculatedDiscount - round(($calculatedDiscount * $ride[0]->percent)/100)?>$</td>
                    </tr>
                    <tr>
                        <td>20+</td>
                        <td><span class="old"><?=$calculated=$calculated - round(($calculated * $ride[0]->percent)/100)?>$</span> <?=$calculatedDiscount=$calculatedDiscount - round(($calculatedDiscount * $ride[0]->percent)/100)?>$</td>
                    </tr>
                    <?php endif;?>
                        
                </table>
            </div>
        </div>
        <div id="ride-pw">
            <div id="right-pw">
            <?php foreach($ride as $r):?>
            <?php if($r->src != $ride[0]->src):?>
                <div class="pw-img left">
                    <img src="<?=$r->src?>" alt="<?=$r->pName?>"/>
                </div>
            <?php else: continue; endif;?>
            <?php endforeach;?>
                    
                <div class="cleaner"></div>
            </div>
        </div>
    </div>
<?php else: header("Location: index.php?page=catalog"); endif; endif;?>
