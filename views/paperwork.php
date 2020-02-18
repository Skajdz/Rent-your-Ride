<?php 
    if(isset($_GET['page']) && isset($_GET['ride']) && $_GET['ride'] != '' && preg_match("/^[0-9]+$/", $_GET['ride']) && isset($_SESSION['user'])):
    $ride = getRide($_GET['ride']);
    $firstName = "";
    $lastName = "";
    $email = "";
    $dL = "";
    $pN = "";
    $readOnly = "";
    if(isset($_SESSION['user'])){
        $firstName = $_SESSION['user'] -> firstName;
        $lastName = $_SESSION['user'] -> lastName;
        $email = $_SESSION['user'] -> email;
        $dL = $_SESSION['user'] -> licence;
        $pN = $_SESSION['user'] -> phone;
        $readOnly = "readonly";
    }
    if(ifActiveRent($_SESSION['user']->idK)){
        header("Location: index.php?page=user");
    }

?>
<div id="paperwork-content">
            <div id="paperwork-holder">
                <div id="paperwork-Headline">
                    <h1>Paperwork</h1>
                    <h2><a href="index.php?page=ride_details&ride=<?=$ride[0] -> idR?>"><?=$ride[0] -> pName?></a></h2>
                </div>
                <form action="#" method="POST">
                    <div id="paperwork-table1">
                        <table>
                            <tr>
                                <td>
                                    <input type="text" id="firstName" value = "<?=$firstName?>" name="firstName" placeholder="First name" <?=$readOnly?>/>
                                </td>
                                <td>
                                    <input type="text" id="lastName" value = "<?=$lastName?>" name="lastName" placeholder="Last name" <?=$readOnly?>/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="Email" value = "<?=$email?>"  name="email" placeholder="Email" <?=$readOnly?>/>
                                </td>
                                <td>
                                    <input type="text" id="driversLicence" value = "<?=$dL?>"  name="driversLicence" placeholder="Driver's licence" <?=$readOnly?>/>
                                </td>
                            </tr>
                    
                    
                            <tr>
                                <td>
                                    <input type="text" id="phoneNumber" value = "<?=$pN?>"   name="phoneNumber" placeholder="Phone number" <?=$readOnly?>/>
                                </td>
                                <td>
                                    <input type="text" id="adress"  name="adress" placeholder="Pickup/Return Adress"/>
                                </td>
                            </tr>
                    
                        </table>
                    </div>
                    <div id="paperwork-table2">
                        <table>
                            <tr>
                                <th>
                                    <h2>Pickup</h2>
                                </th>
                                <th>
                                    <h2>Return</h2>
                                </th>
                            </tr>
                           
                            <tr>
                                <td>
                                    <input name="pDateP" id = "dateP" type="datetime-local"/>
                                </td>
                                <td>
                                    <input name="pDateR" id = "dateR" type="datetime-local" readonly/>
                                </td>
                            </tr>
                           
                        </table>
                    </div>
                    
                    <div id="paperwork-tos">
                        <span id="text"></span><input type="checkbox" name="tos" id="tos" value="1"/> I have read and agree with the <a href="index.php?page=Terms">terms and conditions</a>.
                    </div>
                    <div id="bonusPCheck">
                    <input type="checkbox" name="bonusP" id="bPC" value="1"/> Bonus Package.
                    </div>
                    <div id="total-Price">
                        <h3 >Total price: <span id = "totalP">0</span>$</h3>
                    </div>
                    <div id="paperwork-submit">
                        <input type = "text" name = "hiddenidR" id = "hiddenidR" value = "<?=$ride[0] -> idR?>" hidden />
                        <input type = "text" name = "userId" id = "userId" value = "<?=$_SESSION['user'] -> idK?>" hidden />
                        <input type = "text" name = "hiddenBpPrice" id = "hiddenBpPrice" value = "<?=$ride[0] -> bpPrice?>" hidden/>
                        <input type="text" name="hiddenPrice" id="hiddenPrice" value = "<?=$ride[0] -> price?>" hidden/>
                        <input type="text" name="hiddenDiscount" id="hiddenDiscount" value = "<?=$ride[0] -> discount?>" hidden/>
                        <input type="text" name="hiddenPercent" id="hiddenPercent" value = "<?=$ride[0] -> percent?>" hidden/>

                        <input type="submit" id="paperworkBtn" name="paperworkBtn" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
        <?php else: header("Location: index.php?page=home"); endif;?>