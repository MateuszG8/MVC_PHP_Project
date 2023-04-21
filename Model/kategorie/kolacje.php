<?php
session_start();
$_SESSION['Category']=3;
$_SESSION['View']=0;
header('Location:../../Controller/index.php');