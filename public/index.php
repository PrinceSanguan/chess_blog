<?php

session_start();

require "../app/core/init.php";

$url = $_GET['url'] ?? "home";
$url = strtolower($url);
$url = explode("/", $url);

$page_name = trim($url[0]);
$filename = "../app/pages/".$page_name.".php";


/**Set Pagination vars */
$page_number = $_GET["page"] ?? 1;
$page_number = empty($page_number) ? 1 : (int)$page_number;

$current_link = $_GET['url'] ?? "home";
$current_link = ROOT . "/" . $current_link;

foreach ($_GET as $key => $value) {

  if ($key != "url")
  $current_link .= "&".$key."=".$value;

}

echo $current_link;die;

if(file_exists($filename))
{
  require_once $filename;
} else {
  require_once $filename = "../app/pages/404.php";
}
