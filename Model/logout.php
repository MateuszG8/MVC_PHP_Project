<?php
session_start();
session_unset();
header('Location:../Controller/index.php');
?>
