<?php
require_once("conn.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/styles.css">

    <title>Hello, world!</title>
    <script src="https://kit.fontawesome.com/f5b4375698.js" crossorigin="anonymous"></script>
  </head>
  <body>

  <header>
  <nav class="navbar navbar-expand-lg">
  <a class="navbar-brand ml-5" href="http://<?php echo $_SERVER['SERVER_NAME'];?>">Crowns & Jewels</a>

 <!-- search bar -->
  <form action="/articles.php" class="form-inline my-2 my-lg-0 ml-auto ">
    <div class="input-group">
      <input class="form-control bg-transparent text-white" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php (isset($_GET["search"])) ? $_GET["search"] : ""; ?>">
      <div class="input-group-append">
        <button class=" btn btn-light text-warning my-2 my-sm-0" type="submit">Search</button>
      </div>
    </div>
  </form>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse col-md-3" id="navbarSupportedContent">
  
    <ul class="navbar-nav ml-auto mr-5">
      <li class="nav-item">
        <a class="nav-link" href="http://<?php echo $_SERVER['SERVER_NAME'];?>">Home</a>
      </li>
     
      <?php
      if( isset($_SESSION["user_id"])): //check if user is logged in (we created user id in login.php)
      ?>

      <li class="nav-item">
        <a href="/members.php" class="nav-link">Members</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/profile.php">My Profile</a>
          <a class="dropdown-item" href="/add_post.php">Add Articles</a>
          <a class="dropdown-item" href="articles.php">Articles</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/actions/login.php?action=logout">Logout</a>
        </div>
      </li>
      <?php
      else: //if user is not logged in 
        ?>
          <li class="nav-item"> 
            <a class="nav-link" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/signup.php">Login / Sign-up</a>
          </li>

        <?php

      endif;
      ?>


    </ul>
    
  </div>
  
</nav>
    </header>