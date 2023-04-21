<?php
session_start();
$_SESSION['Category']=4;
$_SESSION['View']=0;
header('Location:../../Controller/index.php');