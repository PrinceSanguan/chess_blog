<?php

if($_SERVER['SERVER_NAME'] == "localhost")
{
  define("DBUSER", "root");
  define("DBPASS", "");
  define("DBNAME", "chess");
  define("DBHOST", "localhost");
  define("ROOTS", 3307);
  
}else 
{
  define("DBUSER", "root");
  define("DBPASS", "");
  define("DBNAME", "chess");
  define("DBHOST", "localhost");
  define("ROOTS", 3307);
}