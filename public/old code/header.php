<?php

//include("php/connect.php");
include("php/session.php");
include("php/encrypt_func.php");

?>

<html>
  <head>

    <title>Collab | <?php echo "(" . $Org . "/" . $Depa . "/" . $Pos . ")" . "(" . $Fname . " " . $Lname . ")"?></title>


    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="collabbb/images.css">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->




    <style>
      #bar1
    {

      background-color: #4097c8;
          width:800px;
          margin:auto;
          margin-top: 50px;
          padding:10px;
          padding-top: 50px;
          text-align: left;
          font-weight: bold;

    }

    #text
    {

      height: 40px;
      width: 300px;
      border-radius: 4px;
      border:solid 1px #ccc;
      padding: 4px;
      font-size: 14px;
    }
    #text1
    {

      height: 400px;
      width: 800px;
      border-radius: 4px;
      border:solid 1px #ccc;
      padding: 4px;
      font-size: 14px;
    }

    #button
    {

      width: 200px;
      height: 40px;
      border-radius: 4px;
      font-weight: bold;
      border:none;
      background-color: #e5ba27;
      color: black;
    }
    #bar 
      {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #4097c8;
      }
      table 
    {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      
    }

    td, th 
    {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }

      li 
      {
        float: left;
      }

      li a 
      {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
      }

      li 
      a:hover:not(.active) 
      {
        background-color: #e5ba27;
      }

      .active 
      {
        background-color: #04AA6D;
      }
      </style>
  </head>
  
  <body style="font-family: tahoma;background-color: #d0d8e4;">

  <?php

  if ($type == "admin") 
  {
    include("admin_navbar.php");
  }
  else
  {
    include("navbar.php");
  }

?>