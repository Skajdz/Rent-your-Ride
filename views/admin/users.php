<div id="content-users">
    <?php if($_SESSION['user']->name == "Super-Admin"):?>
    <div id = "add">  
        <h1> Add an Admin </h1>  
        <div id="inputs">
            <table>
                <tr>
                    <td><p>Name</p></td>
                    <td><p>Password</p></td>
                </tr>
                <tr>
                    <td><input type = "text" placeholder = "Name" id = "idName" name="idName"/></td>
                    <td><input type = "password" placeholder = "Password" id = "passUU" name="passUU"/></td>
                </tr>
                <tr>
                    <td colspan = "2" ><p>Email</p></td>
                </tr>
                <tr>
                    <td colspan = "2"><input type = "text" placeholder = "Email" id = "emailUU" name="emailUU"/></td>
                    
                </tr>
                <tr>
                    <td colspan = "2"><input type = "submit"  id = "submitUU" value = "Submit" name="submitUU"/></td>
                </tr>
            </table>
        </div>
    </div>
    <?php endif;?>
    <?php 
        $users = executeQuery("SELECT * FROM user u INNER JOIN role r ON u.idU=r.idU");
    ?>
    <div id = "admins">
        <h1> List of Admins</h1>
        <div class = "adminsL">
            <table>
                <?php foreach($users as $u): if($u -> name == "Admin"):?>
                <tr>
                    <td><p><?=$u ->name?></p></td>
                    <td><p><?=$u ->firstName?></p></td>
                    <td><p><?=$u ->email?></p></td>
                </tr>
                <tr></tr><tr></tr><tr></tr><tr></tr>
                <?php endif; endforeach;?>
                
            </table>
        </div>
    </div>
    <div id = "users">
        <h1>List of Users</h1>
        <div class = "usersL">
            <table>
            <?php foreach($users as $u): if($u -> name == "Korisnik"):?>
                <tr>
                    <td><p><?=$u ->firstName?></p></td>
                    <td><p><?=$u ->lastName?></p></td>
                    <td><p><?=$u ->email?></p></td>
                    <td><p><?=$u ->phone?></p></td>
                </tr>
                <tr></tr><tr></tr><tr></tr><tr></tr>
            <?php endif; endforeach;?>
                
            </table>
        </div>
    </div>
</div>