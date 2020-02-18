<div id="content-users">
    <div id = "users">
        <h1>Activity log</h1>
        <?php $log = executeQuery("SELECT * FROM `activity` ORDER BY dat DESC");?>
        <div class = "usersL Rdm">
            <table>
                <tr>
                    <th><p>Person</p></th>
                    <th><p>Action</p></th>
                    <th><p>Object</p></th>
                    <th><p>Additional info</p></th>
                    <th><p>Date</p></th>
                </tr>
                <tr></tr><tr></tr><tr></tr><tr></tr>
                <?php foreach($log as $l): ?>
                <tr>
                    <td><p><?= $l->who?></p></td>
                    <td><p><?= $l->act?></p></td>
                    <td><p><?=$l->obj?></p></td>
                    <td><p><?= $l->info?></p></td>
                    <td><p><?= $l->dat?></p></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>