<?php 
    if(isset($_SESSION['user'])){
    header("Location: index.php?page=home");
    }
?>
<div id="reg-content">
            <div id="reg-holder">
                <h1>Registration</h1>
                <div id="input-holder">
                    <form action="#" method="POST">
                        <input type="text" id="firstNameReg" name="firstNameReg" placeholder="Firstname"/>
                        <input type="text" id="lastNameReg" name="lastNameReg" placeholder="LastName"/>
                        <input type="text" id="emailReg" name="emailReg" placeholder="Email"/>
                        <input type="password" id="passwordReg" name="passwordReg" placeholder="Password"/>
                        <input type="password" id="passwordCReg" name="passwordCReg" placeholder="Confirm Password"/>
                        <input type="text" id="driversC" name="driversC" placeholder="Driver's Licence"/>
                        <input type="text" id="phoneReg" name="phoneReg" placeholder="Phone number"/>
                        <input type="submit" id="regSubmit" name="regSubmit" value="Register"/>
                    </form>
                </div>
            </div>
        </div>