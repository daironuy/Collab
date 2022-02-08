<?php 

include("php/code.php");

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="collabbb/images.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<style type="text/css">
body
{
    background:url('BG-9.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    min-height: 1000%;
}
.wrapper 
{
    margin: 100px; 
}
.form-signin 
{
    max-width: 380px;
    margin: 0 auto;
    background-color: rgb(233, 238, 247);
    padding: 50px 50px 50px;
    border: 1px solid #0c0c0c;
    border-radius: 10px;
}
.form-signin input[type="text"], .form-signin input[type="password"] 
{
    margin-bottom: 30px;
}

</style>

</head>

<body>

<div class="wrapper">

<form class="form-signin" method="post" autocomplete="off">
  
  <h3 class="form-signin-heading text-center">PLS Enter Code</h3><br>

  <?php //include("php/tfuc.php"); ?>

  <input class="form-control" type="text" name="code" placeholder="code" />
  
  
  <div class="d-grid gap-2 col-6 mx-auto">
    <button class="btn btn-primary" name="submit" type="submit">Submit</button>
  </div>

</form>
    
</div>

</body>
</html>