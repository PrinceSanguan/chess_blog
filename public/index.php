<?php

$url = $_GET['url'] ?? "home";
$url = explode("/", $url);


echo "<pre>";
print_r($url);

//echo "home page";