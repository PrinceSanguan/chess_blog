<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Home - <?=APP_NAME?></title>

    <link rel="icon" type="image/png" href="<?=ROOT?>/assets/images/chess-icon.png">
    <link href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/css/bootstrap-icons.css" rel="stylesheet">

    
    <!-- Custom styles for this template -->
    <link href="<?=ROOT?>/assets/css/headers.css" rel="stylesheet">
  </head>

  <body>

  <header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <img class="bi me-2" src="<?=ROOT?>/assets/images/chess-icon.png" width="40" height="32" style="object-fit: cover;">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="<?=ROOT?>" class="nav-link px-2 <?=$url[0] == "home" ? "link-primary" : "link-dark" ?>">Home</a></li>
          
          <li><a href="<?=ROOT?>/blog" class="nav-link px-2 <?=$url[0] == "blog" ? "link-primary" : "link-dark" ?>">Blog</a></li>

<!------------------------------------------Books Dropdown------------------------------------------------->
          <li class="nav-item dropdown">
              <a href="#" class="nav-link px-2 link-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Books
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a class="dropdown-item" href="<?=ROOT?>/woodpecker">The Woodpecker Method</a></li>
                <li><a class="dropdown-item" href="<?=ROOT?>/garrykasparov">Garry Kasparov Greatest Games</a></li>
                   <style>
                      .dropdown-menu .dropdown-item {
                      font-size: 0.80rem; /* Adjust the value as needed */
                      }
                    </style>
              </ul>
          </li>
<!------------------------------------------Books Dropdown------------------------------------------------->
            <span class="nav-link px-2 link-dark dropdown text-end">
              <a href="#" class="d-block <?=$url[0] =='category' ? 'link-primary':'link-dark'?> text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Category
              </a>
              <ul class="dropdown-menu text-small">
               
               <?php  

                  $query = "select * from categories order by id desc";
                  $categories = query($query);
                ?>
                <?php if(!empty($categories)):?>
                  <?php foreach($categories as $cat):?>
                    <li><a class="dropdown-item" href="<?=ROOT?>/category/<?=$cat['slug']?>"><?=$cat['category']?></a></li>
                  <?php endforeach;?>
                <?php endif;?>
              </ul>
            </span>
          </li>
        </ul>

        <form action="<?=ROOT?>/search" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
        <div class="input-group">
          <input value="<?=$_GET["find"] ?? ""?>" name="find" type="search" class="form-control" placeholder="Search..." aria-label="Search">
          <button class="btn btn-primary">Find</button>
        </div>
        </form>

        <?php if(logged_in()): ?>
    <div class="dropdown text-end">
        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?=get_image(user("image"))?>" alt="mdo" style="object-fit: cover;" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="#">Hi, <?=user("username")?></a></li>
            <li><a class="dropdown-item" href="<?=ROOT?>/admin/dashboard">Admin</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?=ROOT?>/logout">Sign out</a></li>
        </ul>
    </div>
    
    <?php else: ?>
        <!--<a href="<?=ROOT?>/login" class="text-body-emphasis text-decoration-none">Sign in</a>-->
    <?php endif; ?>

      </div>
    </div>
  </header>

  <?php

  if($url[0] == "home")
    include "./app/pages/includes/slider.php";
  ?>

  <main class="p-2">