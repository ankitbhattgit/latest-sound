<?php
error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED);
$clientId="10795ee3fb0bc2f1ba76f33d92e75ac7";
$clientSecret="b1bb0d93211f90dd1648a76947bd4b9d";
$callback="http://localhost/sound/callback.php";

require_once 'lib/Soundcloud.php';
$soundcloud = new Services_Soundcloud($clientId, $clientSecret, $callback);