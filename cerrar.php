<?php

session_start();
unset ($SESSION['logueado']);
session_destroy();

header('Location: index.php');

?>