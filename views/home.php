<div id="content">
            <div id="holder">
            
                <div id="banner-1">
                   
                
                    <div id="comodities">
                        <h2>No hidden fees!</h2>
                            <ul>
                                <li>Rent a ride without deposit</li>
                                <li>Free GPS navigation</li>
                                <li>Travel Insurance</li>
                                <li>Free Childseats</li>
                                <li>Unlimited KM</li>
                            </ul>
                    </div>
                </div>
            </div>
            <div id=banner-2-holder>
                <div id="banner-2">
                    <h3>Why chose <span class="red">RR</span>?</h3>
                    <p><span class="red">Rent your Ride</span> offers a wide range of rides for rent. The vehicles we offer have space for 5 to 9 passengers. Every ride is regularly serviced and maintained, and fully prepared for both summer and winter driving. Also, you can opt to aquire the bonus package that comes with the vehicle for a reasonable price.</p>
                </div>
            </div>
            <!-- Select upit za vozila sa popustom-->
            <?php
                $rides = executeQuery("SELECT r.*, p.name AS pName, p.src, p.main FROM ride r INNER JOIN ridepic rp ON r.idR=rp.idR INNER JOIN picture p ON rp.idS=p.idS WHERE p.main=1 AND r.discount IS NOT NULL LIMIT 0,3");
            ?>

            <div id="discounts">
                <h4>Rent these rides with a discount</h4>
                <!--Foreach za vozila sa popustom -->
                <?php foreach($rides as $ride):?>
                <div class="discount-vehicle">
                    <div class="img-holder">
                    <a href="index.php?page=ride_details&ride=<?=$ride->idR?>">
                        <img src="<?= $ride->src?>" alt="<?= $ride->pName?>"/>
                    </a>
                    </div>
                    <h5><?= $ride->pName?></h5>
                    <p><?= $ride->description?> </p>
                    <div class="bot"><a href="index.php?page=ride_details&ride=<?=$ride->idR?>">Choose this Ride</a></div>
                </div>
                <?php endforeach;?>
            </div>
            <!-- Select upit za 4 vozila koja nemaju trenutno popust-->
            <?php $rides = executeQuery("SELECT r.*, p.name AS pName, p.src, p.main FROM ride r INNER JOIN ridepic rp ON r.idR=rp.idR INNER JOIN picture p ON rp.idS=p.idS WHERE p.main=1 AND r.discount IS NULL LIMIT 4"); ?>

            <div id="catalog">
                <h4>Rides from our catalog</h4>
                <!--Ispis vozila bez popusta(4) -->
                <?php foreach($rides as $ride):?>
                <div class="catalog-vehicle">
                    <div class="catalog-img-holder">
                        <div class="catalog-price-holder">
                            <p>Starting at <?=$ride->price?>$/day</p>
                            <a href="index.php?page=ride_details&ride=<?=$ride->idR?>">
                                <img src="<?=$ride->src?>" alt="<?=$ride->pName?>"/>
                            </a>
                        </div>
                    </div>
                    <div class="catalog-car-name">
                        <h5><?=$ride->pName?></h5>
                    </div>
                    <div class="catalog-reservation">
                        <a href="index.php?page=ride_details&ride=<?=$ride->idR?>">Make a Reservation</a>
                    </div>
                    
                </div>
                <?php endforeach;?>
                
            </div>
        </div>
        <div id="banner-3">
            <div id="banner-3-holder">
                <div id="headline-holder">
                    <h3>Check out our full collection of Rides</h3>
                </div>  
                <div id="link-holder" >
                    <a href="index.php?page=catalog">All rentable Rides</a>
                </div>
                <div class="cleaner"></div>
            </div>
        </div>