<?php

ob_start();
session_start();
$_SESSION["ogr"] = false;
$_SESSION["aka"] = false;
session_unset();
session_destroy();
header("Location: ../index.php");
