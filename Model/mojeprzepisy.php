<?php
session_start();
$_SESSION['Owner']=1;
header('Location:../Controller/index.php');