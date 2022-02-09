<?php

//session_start();



unset($_SESSION['collab_id']);

// $_SESSION['collab_id'] == "";


header("Location: login.php");
die;