<?php

function query(string $query, array $data = [])
{

    $string = "mysql:host=localhost;port=3307;dbname=chess"; 
    $con = new PDO($string, DBUSER, DBPASS);

    
    $stm = $con->prepare($query);
    $stm->execute($data);

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    if(is_array($result) && !empty($result))
    {
      return $result;
    }

    return false;
}


function query_row(string $query, array $data = [])
{

    $string = "mysql:host=localhost;port=3307;dbname=chess"; 
    $con = new PDO($string, DBUSER, DBPASS);

    
    $stm = $con->prepare($query);
    $stm->execute($data);

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    if(is_array($result) && !empty($result))
    {
      return $result[0];
    }

    return false;
}


function redirect($page) {
  header('Location: '.ROOT. '/' . $page);
  die;
}

function old_value($key, $default = "") {

  if(!empty($_POST[$key])) 
    return $_POST[$key];
    
  return $default;
}

function old_checked($key, $default = "") {

  if(!empty($_POST[$key]))
      return "checked";

  return "";
  
}

function get_image($file)
{
	$file = $file ?? '';
	if(file_exists($file))
	{
		return ROOT.'/'.$file;
	}

	return ROOT.'/assets/images/3.jpg';
}


function str_to_url($url)
{

  $url = str_replace("'", "", $url);
  $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
  $url = trim($url, "-");
  $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
  $url = strtolower($url);
  $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

  return $url;
}


function resize_image($filename, $max_size = 1000)
{
	
	if(file_exists($filename))
	{
		$type = mime_content_type($filename);
		switch ($type) {
			case 'image/jpeg':
				$image = imagecreatefromjpeg($filename);
				break;
			case 'image/png':
				$image = imagecreatefrompng($filename);
				break;
			case 'image/gif':
				$image = imagecreatefromgif($filename);
				break;
			case 'image/webp':
				$image = imagecreatefromwebp($filename);
				break;
			default:
				return;
				break;
		}

		$src_width 	= imagesx($image);
		$src_height = imagesy($image);

		if($src_width > $src_height)
		{
			if($src_width < $max_size)
			{
				$max_size = $src_width;
			}

			$dst_width 	= $max_size;
			$dst_height = ($src_height / $src_width) * $max_size;
		}else{
			
			if($src_height < $max_size)
			{
				$max_size = $src_height;
			}

			$dst_height = $max_size;
			$dst_width 	= ($src_width / $src_height) * $max_size;
		}

		$dst_height = round($dst_height);
		$dst_width 	= round($dst_width);

		$dst_image = imagecreatetruecolor($dst_width, $dst_height);
		imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
		
		switch ($type) {
			case 'image/jpeg':
				imagejpeg($dst_image, $filename, 90);
				break;
			case 'image/png':
				imagepng($dst_image, $filename, 90);
				break;
			case 'image/gif':
				imagegif($dst_image, $filename, 90);
				break;
			case 'image/webp':
				imagewebp($dst_image, $filename, 90);
				break;

		}

	}
}




function esc($str)

{
  return htmlspecialchars($str ?? "");
}



function authenticate($row) {
  $_SESSION["USER"] = $row;
}

function logged_in() {
  if(!empty($_SESSION["USER"]))
    return true;

    return false;
}

// create_tables();
function create_tables()
{
    $string = "mysql:host=localhost;port=3307"; // Adjust the port as needed
    $con = new PDO($string, DBUSER, DBPASS);

    // Create the database if it doesn't exist
    $query = "CREATE DATABASE IF NOT EXISTS " . DBNAME;
    $stm = $con->prepare($query);
    $stm->execute();

    // Use database that you created
    $query = "USE " . DBNAME;
    $stm = $con->prepare($query);
    $stm->execute();

    // Create the table for users
    $query = "CREATE TABLE IF NOT EXISTS users(

      id int primary key auto_increment,
      username varchar(50) not null,
      email varchar(100) not null,
      password varchar(255) not null,
      image varchar(1024) null,
      date datetime default current_timestamp,
      role varchar(10) not null,

      key username (username),
      key email (email)

    )";
    $stm = $con->prepare($query);
    $stm->execute();

    // Create the table for categories
    $query = "CREATE TABLE IF NOT EXISTS categories(

      id int primary key auto_increment,
      category varchar(50) not null,
      slug varchar(100) not null,
      disabled tinyint default 0,
      

      key slug (slug),
      key category (category)

    )";
    $stm = $con->prepare($query);
    $stm->execute();

    // Create the table for posts
    $query = "CREATE TABLE IF NOT EXISTS posts(

      id int primary key auto_increment,
      user_id int,
      category_id int,
      title varchar(100) not null,
      content text null,
      image varchar(1024) null,
      date datetime default current_timestamp,
      slug varchar(100) not null,
      
      key user_id (user_id),
      key category_id (category_id),
      key title (title),
      key slug (slug),
      key date (date)

    )";
    $stm = $con->prepare($query);
    $stm->execute();


}