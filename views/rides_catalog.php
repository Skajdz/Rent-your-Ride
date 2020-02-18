<?php
    $link=0;
    if(isset($_SESSION['link'])){
    $link= $_SESSION['link'];
    }
    $num = $link * 3;
    $rides = executeQuery("SELECT r.*, p.name AS pName, p.src, p.main FROM ride r INNER JOIN ridepic rp ON r.idR=rp.idR INNER JOIN picture p ON rp.idS=p.idS WHERE p.main=1 LIMIT $num, 3");
    
?>
<div id="content-rides">
    <div id="banner-rides">
        <div id="rides-header">
            <h3>All Rides</h3>
        </div>
        <div id="rides-misc">
            <?php $totalRides = executeQuery("SELECT COUNT(*) AS counted FROM ride");
                    $totalPages = ceil($totalRides[0]->counted/3);
            ?>
            <div id="total" class="right">Total: <?=$totalRides[0]->counted?> rides</div>
            <div class="cleaner"></div>
        </div>
    </div>
    <div id="rides">
        <?php foreach($rides as $ride):?>
        <div class="ride">
            <div class="ride-img left">
            <a href="index.php?page=ride_details&ride=<?=$ride->idR?>">
                <img src="<?=$ride->src?>" alt="<?=$ride->pName?>"/>
            </a>
            </div>
            <div class="ride-desc right">
                <a href="index.php?page=ride_details&ride=<?=$ride->idR?>">
                    <h4><?=$ride->pName?></h4>
                </a> 
                <?php if($ride->discount == null): ?>
                <h5>From: <?=$ride->price?>$/day</h5>
                <?php else:?>
                <h5>From: <span class="old"><?=$ride->price?>$</span> <?=$ride->discount?>$/day</h5>
                <?php endif;?>
                <div class="package-img">
                    <img src="Slike/package_1.png"/>
                </div>
                <div class="hidden-p">
                    <p><?=$ride->bonusP?></p>
                </div>
                <div class="ride-link">
                    <a href="index.php?page=ride_details&ride=<?=$ride->idR?>">Rent this Ride</a>
                </div>
            </div>
        </div>
        <?php endforeach;?> 
        
    </div>
    <?php if($totalPages > 1):?>
    <div id="arrows">
        <?php if($link>0):?>
        <a href = "#rides-header" class="pag" data-id="<?=$link-1?>"><img class = "rotated pag" src = "Slike/arrow.png" alt = "arrow png"/></a> 
        <?php endif; ?>
        <?php if($link<($totalPages-1)):?>
        <a href = "#rides-header" class = "pag" data-id = "<?=$link+1?>"><img src = "Slike/arrow.png" alt = "arrow png"/></a>
        <?php endif?>
    </div>
    <?php endif;?>
</div>