<?php

$token = bin2hex(random_bytes(32));
$token = str_shuffle($image_token);
$token = substr($image_token, 0, 4);
$token = hash('ripemd128', $token);

?>