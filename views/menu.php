<body>
        <div id="header">
            <div id="header-1">

            <?php
                $href = "";
                if(isset($_SESSION['user'])){
                    if($_SESSION['user']->name != "Korisnik"){
                        $href = "index.php?admin";
                    }else $href = "index.php";
                }else $href = "index.php";
            ?>

                <div id="logo">
                    <div id="logo-png"><a href =<?=$href?>><img src="Slike/logo.png" alt="Rent your Ride logo"/></a></div>
                    <span id="logo-text"><a href = <?=$href?>><p>Rent your Ride</p></a></span>
                    <div class="cleaner"></div>
                </div>
                <div id="menu">
                    <ul>
                        <li><a href="index.php?page=home">Home</a></li>
                        <li><a href="index.php?page=catalog">Rentable rides</a></li>
                        <li><a href="index.php?page=Terms">ToS</a></li>
                    </ul>
                </div>
                <div id="login">
                 
                    <?php if(isset($_SESSION["user"])):?>
                        <h1><a href="index.php?page=user"><?=$_SESSION["user"]->firstName ?> <?=$_SESSION["user"]->lastName ?></a></h1>
                    <div id="logout">
                        <a href="php/logout.php">Logout</a>
                    </div>
                    <?php else: ?>
                    <form action="php/login.php" method="POST">
                        <input id="email" placeholder="Email" name="email" type="text"/>
                        <input id="password" placeholder="Password"name="password" type="password"/>
                        <br/>
                        <div id="login-div" class="left">
                            <button name="loginBtn" type="submit" id="loginBtn" >Login</button>
                            <!--<input id="loginBtn" name="loginBtn" type="button" value="Login"/>-->
                        </div>
                        <div id="registerLink" class="left"><a href="index.php?page=registration">Register</a>
                    </form>
                    <?php endif; ?>
                </div>
                <div class="cleaner"></div>
            </div>
            
        </div>
        <?php if(isset($_SESSION['info'])):?>
        <div class="infoPopUp"><p class = "<?=$_SESSION['color']?>"><?=$_SESSION['info']?></p></div>
        <?php unset($_SESSION['info']); endif; ?>