<?php
session_start();
$_SESSION['View']=1;
header('Location:../Controller/index.php');