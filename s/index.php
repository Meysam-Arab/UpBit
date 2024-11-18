<?php
/**
 * Created by PhpStorm.
 * User: Amir
 * Date: 4/24/2017
 * Time: 5:13 PM
 */
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (strpos($actual_link, 's.upbit.ir/') !== false) {
    $s="https://storage.pwrtelegram.xyz/".$_GET['link'];
    echo $s;
    header("Location: ".$s);
}
?>