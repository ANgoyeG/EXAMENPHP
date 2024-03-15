<?php
session_start();
include'pageconnexion.php';

session_destroy();
header("Location: ACCUEIL.php");
exit();
?>
