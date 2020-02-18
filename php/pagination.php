<?php
session_start();
header("Location: application/json");
$data = "Wrong data sent";
$code = 400;
if(isset($_POST['send'])){
    $link = $_POST['num'];
    $_SESSION['link'] = $link;
    $code = 200;
    $data = "Page selected";
}
http_response_code($code);
echo json_encode($data);